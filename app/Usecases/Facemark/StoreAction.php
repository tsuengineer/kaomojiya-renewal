<?php

namespace App\Usecases\Facemark;

use App\Http\Requests\FacemarkStoreRequest;
use App\Models\Facemark;
use App\Models\Tag;
use App\Utils\ResponseUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Uid\Ulid;

class StoreAction
{
    private Ulid $ulid;

    public function __invoke(FacemarkStoreRequest $request): ResponseUtil
    {
        $this->ulid = Str::ulid();

        try {
            $facemark = $this->createFacemark($request);

            if ($request->has('tags') && is_array($request->tags)) {
                $tags = collect(array_filter($request->tags))->map(function ($tagName) {
                    return Tag::query()->firstOrCreate(['name' => $tagName]);
                });
            } else {
                $tags = collect();
            }

            $facemark->tags()->sync($tags->pluck('id'));
        } catch (\Exception $e) {
            if (isset($facemark)) {
                $facemark->delete();
            }

            Log::error('Failed to save facemarks.', ['exception' => $e]);
            return ResponseUtil::createWithErrors(['tags' => 'Failed to save tags.']);
        }

        return ResponseUtil::createSuccess();
    }

    private function createFacemark(FacemarkStoreRequest $request): Facemark
    {
        $data = $request->only(['data']);

        return Facemark::create($data + ['user_id' => Auth::user()->id, 'ulid' => $this->ulid]);
    }
}

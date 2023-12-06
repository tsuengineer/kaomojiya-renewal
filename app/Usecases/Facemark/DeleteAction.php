<?php

namespace App\Usecases\Facemark;

use App\Models\Facemark;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteAction
{
    public function __invoke(Facemark $facemark): bool
    {
        DB::beginTransaction();
        try {
            $facemark->tags()->detach();
            $this->deleteUnusedTags();
            $facemark->copyHistories()->delete();

            $facemark->delete();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return false;
        }

        DB::commit();

        return true;
    }

    /**
     * 中間テーブルに紐づいていないタグを削除する
     */
    private function deleteUnusedTags(): void
    {
        $unusedTags = Tag::query()->whereDoesntHave('facemarks')->get();

        foreach ($unusedTags as $unusedTag) {
            $unusedTag->delete();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacemarkStoreRequest;
use App\Models\CopyHistory;
use App\Models\Facemark;
use App\Usecases\Facemark\DeleteAction;
use App\Usecases\Facemark\ShowAction;
use App\Usecases\Facemark\StoreAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class FacemarkController extends Controller
{
    public function show(string $ulid, ShowAction $action): Response
    {
        $data = $action($ulid);

        if (!$data) {
            return response()->view('errors.404');
        }

        return response()->view('facemarks.show', $data);
    }

    public function create(): View
    {
        return view('facemarks.create');
    }

    public function store(FacemarkStoreRequest $request, StoreAction $action): RedirectResponse
    {
        $result = $action($request);

        if ($result->isSuccess()) {
            Log::info('Success store.', ['request' => $request]);

            return redirect()->route('facemarks.create')
                ->with('success', __('messages.success_create_facemark'));
        }

        return back()->withErrors($result->getErrors())->withInput();
    }

    public function destroy(string $ulid, DeleteAction $action): Response|RedirectResponse
    {
        $facemark = Facemark::query()->where('ulid', $ulid)->first();

        if (!$facemark) {
            return response()->view('errors.204');
        }

        $action($facemark);

        return redirect()->route('users.index')->with('success', __('messages.success_delete_facemark'));
    }

    public function copy(string $ulid)
    {
        $facemark = Facemark::query()->where('ulid', $ulid)->first();

        if (!$facemark) {
            return null;
        }

        if (!$this->isCopiedFacemark($facemark->id)) {
            $this->incrementFacemarkCopyCount($facemark);
            $this->recordCopyHistory($facemark);
        }
    }

    private function isCopiedFacemark($facemarkId)
    {
        $ipAddress = request()->ip();
        $copyHistory = CopyHistory::query()
            ->where('facemark_id', $facemarkId)
            ->where('ip_address', $ipAddress)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->first();

        return $copyHistory !== null;
    }

    private function incrementFacemarkCopyCount($facemark)
    {
        $facemark->copy_count++;
        $facemark->save();
    }

    private function recordCopyHistory($facemark)
    {
        $copyHistory = new CopyHistory();
        $copyHistory->ip_address = request()->ip();
        $copyHistory->facemark_id = $facemark->id;
        $copyHistory->save();
    }
}

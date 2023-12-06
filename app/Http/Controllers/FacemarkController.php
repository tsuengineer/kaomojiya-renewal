<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacemarkStoreRequest;
use App\Models\Facemark;
use App\Usecases\Facemark\DeleteAction;
use App\Usecases\Facemark\IndexAction;
use App\Usecases\Facemark\StoreAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class FacemarkController extends Controller
{
    public function index(string $ulid, IndexAction $action): Response
    {
        $data = $action($ulid);

        if (!$data) {
            return response()->view('errors.404');
        }

        return response()->view('facemarks.index', $data);
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
}

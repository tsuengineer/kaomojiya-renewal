<?php

namespace App\Http\Controllers;

use App\Usecases\Favorite\DeleteAction;
use App\Usecases\Favorite\StoreAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(int $facemarkId, StoreAction $storeAction): JsonResponse
    {
        if (!Auth::id()) {
            return response()->json([
                'success' => false,
            ]);
        }

        return $storeAction($facemarkId);
    }

    public function destroy(int $facemarkId, DeleteAction $deleteAction): JsonResponse
    {
        if (!Auth::id()) {
            return response()->json([
                'success' => false,
            ]);
        }

        return $deleteAction($facemarkId);
    }
}

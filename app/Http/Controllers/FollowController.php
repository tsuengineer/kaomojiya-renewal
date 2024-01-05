<?php

namespace App\Http\Controllers;

use App\Usecases\Follow\DeleteAction;
use App\Usecases\Follow\StoreAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(int $userId, StoreAction $storeAction): JsonResponse
    {
        if (!Auth::id() || Auth::id() === $userId) {
            return response()->json([
                'success' => false,
            ]);
        }

        return $storeAction($userId);
    }

    public function destroy(int $userId, DeleteAction $deleteAction): JsonResponse
    {
        if (!Auth::id()) {
            return response()->json([
                'success' => false,
            ]);
        }

        return $deleteAction($userId);
    }
}

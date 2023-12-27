<?php

namespace App\Usecases\Favorite;

use Illuminate\Http\JsonResponse;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class DeleteAction
{
    public function __invoke(int $facemarkId): JsonResponse
    {
        $userId = Auth::id();

        $favorite = Favorite::query()->where('facemark_id', $facemarkId)
            ->where('user_id', $userId)->first();

        $favorite?->delete();

        $favoriteCount = Favorite::query()->where('facemark_id', $facemarkId)->count();

        return response()->json([
            'success' => true,
            'favorite_count' => $favoriteCount,
        ]);
    }
}

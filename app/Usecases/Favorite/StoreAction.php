<?php

namespace App\Usecases\Favorite;

use Illuminate\Http\JsonResponse;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class StoreAction
{
    public function __invoke(int $facemarkId): JsonResponse
    {
        $userId = Auth::id();

        $isFavorite = Favorite::query()->where('facemark_id', $facemarkId)->where('user_id', $userId)->exists();

        if (!$isFavorite) {
            $favorite = new Favorite();
            $favorite->user_id = $userId;
            $favorite->facemark_id = $facemarkId;
            $favorite->save();
        }

        $favoriteCount = Favorite::query()->where('facemark_id', $facemarkId)->count();

        return response()->json([
            'success' => true,
            'favorite_count' => $favoriteCount,
        ]);
    }
}

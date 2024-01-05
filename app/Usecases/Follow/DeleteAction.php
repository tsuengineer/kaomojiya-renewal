<?php

namespace App\Usecases\Follow;

use Illuminate\Http\JsonResponse;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class DeleteAction
{
    public function __invoke(int $userId): JsonResponse
    {
        $followingId = Auth::id();

        $follow = Follow::query()->where('follower_id', $userId)->where('following_id', $followingId)->first();

        $follow?->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}

<?php

namespace App\Usecases\Follow;

use App\Models\Follow;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class StoreAction
{
    public function __invoke(int $userId): JsonResponse
    {
        $followingId = Auth::id();

        $isFollow = Follow::query()->where('follower_id', $userId)->where('following_id', $followingId)->exists();

        if (!$isFollow) {
            $follow = new Follow();
            $follow->follower_id = $userId;
            $follow->following_id = $followingId;
            $follow->save();
        }

        return response()->json([
            'success' => true,
        ]);
    }
}

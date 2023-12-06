<?php

namespace App\Usecases\Facemark;

use App\Models\Facemark;

class IndexAction
{
    public function __invoke(string $ulid): array|null
    {
        $facemark = Facemark::with('user', 'user.avatars', 'tags')
            ->withCount('copy_histories')
            ->where('ulid', $ulid)
            ->first();

        if (!$facemark) {
            return null; // null を返すことでコントローラでエラーハンドリングを行う
        }

        $otherFacemarks = Facemark::query()->where('user_id', $facemark->user_id)
            ->where('ulid', '!=', $ulid)
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return [
            'facemark' => $facemark,
            'otherFacemarks' => $otherFacemarks,
        ];
    }
}

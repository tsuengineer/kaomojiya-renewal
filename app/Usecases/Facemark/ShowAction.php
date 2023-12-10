<?php

namespace App\Usecases\Facemark;

use App\Models\Facemark;

class ShowAction
{
    public function __invoke(string $ulid): array|null
    {
        $facemark = Facemark::with('user', 'user.avatars', 'tags')
            ->where('ulid', $ulid)
            ->first();

        if (!$facemark) {
            return null; // null を返すことでコントローラでエラーハンドリングを行う
        }

        return [
            'facemark' => $facemark,
        ];
    }
}

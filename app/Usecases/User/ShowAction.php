<?php

namespace App\Usecases\User;

use App\Models\User;

class ShowAction
{
    public function __invoke(string $slug): array
    {
        $user = User::with(['avatars', 'facemarks' => function ($query) {
            $query->take(10);
        }])
            ->where('slug', $slug)
            ->first();

        return [
            'user' => $user,
        ];
    }
}

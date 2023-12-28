<?php

namespace App\Usecases\User;

use App\Models\Facemark;
use App\Models\User;

class ShowAction
{
    public function __invoke(string $slug): array
    {
        $user = User::with(['avatars'])
            ->where('slug', $slug)
            ->first();

        $postFacemarks = Facemark::whereHas('user', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })
            ->withCount('favorites')
            ->get();

        $favoriteFacemarks = Facemark::whereHas('favorites', function ($query) use ($slug) {
            $query->whereHas('user', function ($userQuery) use ($slug) {
                $userQuery->where('slug', $slug);
            });
        })
            ->withCount('favorites')
            ->get();

        return [
            'user' => $user,
            'postFacemarks' => $postFacemarks,
            'favoriteFacemarks' => $favoriteFacemarks,
        ];
    }
}

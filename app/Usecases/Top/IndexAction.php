<?php

namespace App\Usecases\Top;

use App\Models\Facemark;

class IndexAction
{
    public function __invoke(): array
    {
        $latestFacemarks = Facemark::with('user', 'user.avatars')
            ->withCount('favorites')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        $latestFacemarkIds = $latestFacemarks->pluck('id')->toArray();
        $randomFacemarks = Facemark::with('user', 'user.avatars')
            ->withCount('favorites')
            ->whereNotIn('id', $latestFacemarkIds)
            ->inRandomOrder()
            ->limit(20)
            ->get();

        return [
            'latestFacemarks' => $latestFacemarks,
            'randomFacemarks' => $randomFacemarks,
        ];
    }
}

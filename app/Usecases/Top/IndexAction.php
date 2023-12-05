<?php

namespace App\Usecases\Top;

use App\Models\Facemark;

class IndexAction
{
    public function __invoke(): array
    {
        $latestFacemarks = Facemark::with('user', 'user.avatars')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        $latestFacemarkIds = $latestFacemarks->pluck('id')->toArray();
        $randomFacemarks = Facemark::with('user', 'user.avatars')
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

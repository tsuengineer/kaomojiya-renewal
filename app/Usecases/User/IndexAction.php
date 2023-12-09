<?php

namespace App\Usecases\User;

use App\Models\User;
use Illuminate\Http\Request;

class IndexAction
{
    public function __invoke(Request $request): array
    {
        $users = User::with('avatars', 'facemarks')->get();

        return [
            'users' => $users,
        ];
    }
}

<?php

namespace App\Usecases\Profile;

use App\Models\CopyHistory;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IndexAction
{
    public function __invoke(): Response|array
    {
        $userSlug = Auth::user()->slug;
        $user = User::with('avatars', 'facemarks')
            ->withSum('facemarks', 'copy_count')
            ->where('slug', $userSlug)
            ->first();

        if (!$user) {
            abort(404);
        }

        $facemarks = $user->facemarks()
            ->orderBy('created_at', 'desc')
            ->paginate(40);

        $copyCount = CopyHistory::whereHas('facemark', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        return [
            'user' => $user,
            'facemarks' => $facemarks,
            'copyCount' => $copyCount,
        ];
    }
}

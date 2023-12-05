<?php

namespace App\Usecases\Profile;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class UpdateAction
{
    public function __invoke(User $user, array $data, ?UploadedFile $avatarFile): void
    {
        unset($data['avatar']);
        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($avatarFile) {
            $this->registerAvatar($user, $avatarFile);
        }
    }

    private function registerAvatar(User $user, UploadedFile $avatarFile): void
    {
        $currentAvatar = Avatar::query()->where('user_id', $user->id)->first();
        $filename = Str::random(6) . '.webp';
        $image = Image::make($avatarFile)->fit(300, 300);

        // アバターが既に存在すれば更新、なければ新規作成
        $avatar = $user->avatars ?? new Avatar(['user_id' => $user->id]);
        $avatar->path = $filename;
        $avatar->save();

        $directory = floor($user->id / 1000);

        if ($currentAvatar) {
            Storage::disk('direct')->delete(
                config('image.avatar_path') . '/' . $directory . '/' . $currentAvatar->path
            );
        }

        Storage::disk('direct')->put(
            config('image.avatar_path') . '/' . $directory . '/' . $filename,
            (string)$image->encode()
        );
    }
}

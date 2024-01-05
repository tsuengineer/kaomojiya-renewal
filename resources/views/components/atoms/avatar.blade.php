@if($user?->avatars?->path)
    <img class="w-{{ $size }} h-{{ $size }} rounded-full" src="{{ asset('storage/' . config('image.avatar_path') . '/' . floor($user->id / 1000) . '/' . $user?->avatars->path) }}" alt="" />
@else
    <img class="w-{{ $size }} h-{{ $size }} rounded-full border" src="{{ asset('images/default_user.png') }}" alt="" />
@endif

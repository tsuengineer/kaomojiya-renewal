@if ($type === 'header')
    @if($user?->avatars?->path)
        <img class="w-9 h-9 rounded-full m-auto" src="{{ asset('storage/' . config('image.avatar_path') . '/' . floor($user->id / 1000) . '/' . $user?->avatars->path) }}" alt="" />
    @else
        <img class="w-9 h-9 rounded-full m-auto border" src="{{ asset('images/default_user.png') }}" alt="" />
    @endif
@elseif($type === 'users-show')
    @if($user?->avatars?->path)
        <img class="w-24 h-24 rounded-full m-auto" src="{{ asset('storage/' . config('image.avatar_path') . '/' . floor($user->id / 1000) . '/' . $user?->avatars->path) }}" alt="" />
    @else
        <img class="w-24 h-24 rounded-full m-auto border" src="{{ asset('images/default_user.png') }}" alt="" />
    @endif
@endif

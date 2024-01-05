<button
    class="followButton-{{ $user->id }} btn w-full border border-{{ $color }}-600 bg-white-500 text-{{ $color }}-600 px-4 py-2 rounded transition duration-300 hover:text-white hover:bg-{{ $color }}-600 focus:outline-none"
    onclick="clickFollow({{ $user->id }})"
    data-action="{{ $action }}"
    data-facemark-id="{{ $user->id }}"
>
    {{ $slot }}
</button>

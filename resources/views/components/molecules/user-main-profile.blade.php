<div class="mb-8">
    <h1 class="font-bold">{{ __('messages.profile') }}</h1>
    <div class="flex flex-col mb-4">
        <div class="p-4 bg-gray-100 rounded-lg">
            @if($user->profile)
                {!! nl2br(e($user->profile)) !!}
            @else
                <span class="text-gray-600">{{ __('messages.unset') }}</span>
            @endif
        </div>
    </div>

    @if($user->twitter)
        <div class="text-gray-600">
            twitter: <a href="#" class="text-blue-700">{{ $user->twitter }}</a>
        </div>
    @endif
    @if($user->instagram)
        <div class="text-gray-600 mb-4">
            instagram: <a href="#" class="text-blue-700">{{ $user->instagram }}</a>
        </div>
    @endif

    <div class="flex flex-col">
        <div class="text-gray-600">
            📅{!! $user->created_at->format('Y/n/j') !!} -
        </div>
    </div>
</div>

<section class="w-56 sm:w-36 m-auto sm:m-0">
    <div class="pb-8">
        <figure class="flex justify-center pb-4">
            <x-atoms.avatar :user="$user" size="24"></x-atoms.avatar>
        </figure>
        <div>
            <div class="text-sm text-gray-600">&#64;{{ $user->slug }}</div>
            <div class="font-bold">{{ $user->name }}</div>
        </div>
    </div>
    <div>
        <dl class="flex justify-between pb-2">
            <dt class="font-bold text-sm">{{ __('messages.post_count') }}</dt>
            <dd class="text-sm font-bold">{{ $user->facemarks->count() ?? 0}}</dd>
        </dl>
        <dl class="flex justify-between pb-2">
            <dt class="font-bold text-sm">{{ __('messages.following') }}</dt>
            <dd class="text-sm font-bold">{{ $user->followers?->count() ?? 0 }}</dd>
        </dl>
        <dl class="flex justify-between">
            <dt class="font-bold text-sm">{{ __('messages.followers') }}</dt>
            <dd class="text-sm font-bold">{{ $user->followings?->count() ?? 0 }}</dd>
        </dl>
    </div>
    <div class="text-center my-8">
        @if (Auth::user() && Auth::user()->id !== $user->id)
            @if ($user->followings?->contains(Auth::user()->id))
                <x-atoms.follow-button :user="$user" action="remove" color="red">
                    {{ __('messages.unfollow') }}
                </x-atoms.follow-button>
            @else
                <x-atoms.follow-button :user="$user" action="add" color="blue">
                    {{ __('messages.follow') }}
                </x-atoms.follow-button>
            @endif
        @endif
    </div>
</section>

@include('scripts.follow-script')

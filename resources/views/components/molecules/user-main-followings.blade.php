<div class="mb-8">
    <h1 class="font-bold">{{ __('messages.following') }}</h1>
    <div class="flex flex-col mb-4">
        <ul class="py-2 mb-12">
            @foreach($user->followers as $user)
                <li class="flex justify-between items-center py-4 px-1 border-b">
                    <div class="flex items-center w-8/12">
                        <x-atoms.avatar :user="$user" size="9"></x-atoms.avatar>
                        <div class="pl-4">
                            <div class="text-sm text-gray-600">
                                &#64;{{ $user->slug }}
                                @if (Auth::user() && $user->followers?->contains(Auth::user()->id))
                                    <span class="ml-1 p-1 text-gray-600 bg-gray-100 text-xs rounded">{{ __('messages.follows_you') }}</span>
                                @endif
                            </div>
                            <a class="block font-bold text-xs sm:text-sm md:text-md" href="{{ route('users.show', ['slug' => $user->slug]) }}">
                                {{ $user->name }}
                            </a>
                        </div>
                    </div>

                    <div class="w-24 text-xs md:w-28 md:text-sm">
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
                </li>
            @endforeach
        </ul>
    </div>
</div>

@include('scripts.follow-script')

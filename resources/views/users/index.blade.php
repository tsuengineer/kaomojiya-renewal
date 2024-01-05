@extends('layouts.common')
@include('layouts.header')
@section('title')
    {{ __('title.users') }} ｜{{ config('app.name') }}
@endsection
@section('ogPath'){{ 'images/ogp/main.webp' }}@endsection

@section('content')
    <div class="pt-4 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-2 mb-8 text-sm font-medium">
                {{ Breadcrumbs::render('users') }}
            </div>

            <h1 class="p-2 text-lg md:text-xl font-bold"># {{ __('messages.users') }}</h1>
            <ul class="py-2 mb-12">
                @foreach($users as $user)
                    <li class="flex justify-between items-center py-4 px-1 border-b">
                        <div class="flex items-center w-3/12">
                            <x-atoms.avatar :user="$user" size="9"></x-atoms.avatar>
                            <div class="pl-4">
                                <div class="text-sm text-gray-600">&#64;{{ $user->slug }}</div>
                                <a class="block font-bold" href="{{ route('users.show', ['slug' => $user->slug]) }}">
                                    {{ $user->name }}
                                </a>
                            </div>
                        </div>

                        <div class="m-auto px-4 text-center w-2/12">
                            <div class="text-gray-400 font-bold text-sm">投稿数</div>
                            <div>{{ $user->facemarks->count() ?? 0}}</div>
                        </div>

                        <div class="m-auto px-4 text-center w-2/12">
                            <div class="text-gray-400 font-bold text-sm">フォロー</div>
                            <div>{{ $user->followers?->count() ?? 0 }}</div>
                        </div>

                        <div class="m-auto px-4 text-center w-2/12">
                            <div class="text-gray-400 font-bold text-sm">フォロワー</div>
                            <div>{{ $user->followings?->count() ?? 0 }}</div>
                        </div>

                        <div class="w-24">
                            @if (Auth::user() && Auth::user()->id !== $user->id)
                                @if ($user->followings?->contains(Auth::user()->id))
                                    <x-molecules.follow-button :user="$user" action="remove" color="red">
                                        Unfollow
                                    </x-molecules.follow-button>
                                @else
                                    <x-molecules.follow-button :user="$user" action="add" color="blue">
                                        Follow
                                    </x-molecules.follow-button>
                                @endif
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
@include('layouts.footer')

@include('scripts.follow-script')

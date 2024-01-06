@extends('layouts.common')
@include('layouts.header')
@section('title')
    {{ $facemark->data }} ｜{{ config('app.name') }}
@endsection
@section('ogPath'){{ 'images/ogp/main.webp' }}@endsection

@section('content')
    <div class="pt-4 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-2 mb-8 text-sm font-medium">
                {{ Breadcrumbs::render('facemarks.show', $facemark) }}
            </div>

            <div class="p-2 mt-12">
                <h1 class="pb-4 text-lg md:text-xl font-bold">{{ $facemark->data }}</h1>
                <div class="text-sm text-gray-400">{!! $facemark->created_at->format('Y/m/d') !!}</div>

                @if ($facemark->tags)
                    <ul class="py-2">
                        @foreach ($facemark->tags as $tag)
                            <li class="text-sm">
                                <a href="{{ route('search.index', ['tag' => $tag->name]) }}">
                                    #{{ $tag->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="mt-8">
                    <h2>{{ __('messages.contributor') }}</h2>
                    <a class="flex items-center pb-6" href="{{ route('users.show', ['slug' => $facemark->user->slug]) }}">
                        <x-atoms.avatar :user="$facemark->user" size="9"></x-atoms.avatar>
                        <div class="pl-4">
                            <div class="text-sm text-gray-600">
                                &#64;{{ $facemark->user->slug }}
                                @if (Auth::user() && $facemark->user->followers?->contains(Auth::user()->id))
                                    <span class="ml-1 p-1 text-gray-600 bg-gray-100 text-xs rounded">{{ __('messages.follows_you') }}</span>
                                @endif
                            </div>
                            <span class="block font-bold text-xs sm:text-sm md:text-md">
                                {{ $facemark->user->name }}
                            </span>
                        </div>
                    </a>

                    <div class="w-24 text-xs md:w-28 md:text-sm">
                        @if (Auth::user() && Auth::user()->id !== $facemark->user->id)
                            @if ($facemark->user->followings?->contains(Auth::user()->id))
                                <x-atoms.follow-button :user="$facemark->user" action="remove" color="red">
                                    {{ __('messages.unfollow') }}
                                </x-atoms.follow-button>
                            @else
                                <x-atoms.follow-button :user="$user" action="add" color="blue">
                                    {{ __('messages.follow') }}
                                </x-atoms.follow-button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('layouts.footer')

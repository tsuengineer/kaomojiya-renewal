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
                    <li class="py-2 px-1 border-b">
                        <a href="{{ route('users.show', ['slug' => $user->slug]) }}">
                            {{ $user->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
@include('layouts.footer')

@extends('layouts.common')
@include('layouts.header')
@section('title')
    {{ $user->name }} ｜{{ config('app.name') }}
@endsection
@section('ogPath'){{ 'images/ogp/main.webp' }}@endsection

@section('content')
    <div class="pt-4 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-2 mb-8 text-sm font-medium">
                {{ Breadcrumbs::render('user', $user) }}
            </div>

            <div class="sm:flex sm:grid sm:grid-cols-10">
                <aside class="sm:col-span-3 lg:col-span-2">
                    <x-organisms.user-aside :user="$user"></x-organisms.user-aside>
                </aside>
                <main class="sm:col-span-7 lg:col-span-8 sm:pt-4 sm:pr-4 pt-8 px-4">
                    <x-organisms.user-main :user="$user" :postFacemarks="$postFacemarks" :favoriteFacemarks="$favoriteFacemarks"></x-organisms.user-main>
                </main>
            </div>
        </div>
    </div>
@endsection
@include('layouts.footer')

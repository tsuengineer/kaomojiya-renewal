@extends('layouts.common')
@include('layouts.header')
@section('title')
    {{ __('title.top_page') }} ｜{{ config('app.name') }}
@endsection
@section('ogPath'){{ 'images/ogp/main.webp' }}@endsection

@section('content')
    <div class="pt-4 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-2 mb-8 text-sm font-medium">
                {{ Breadcrumbs::render('top') }}
            </div>

            <div class="flex justify-between items-center">
                <h1 class="p-2 text-lg md:text-xl font-bold"># {{ __('messages.new_arrivals') }}</h1>
            </div>

            <ul class="flex grid lg:grid-cols-2 mb-12">
                @foreach($latestFacemarks as $facemark)
                    <li class="py-2 px-1 border-b">
                        {{ $facemark->data }}
                    </li>
                @endforeach
            </ul>

            <h1 class="p-2 text-lg md:text-xl font-bold"># {{ __('messages.random') }}</h1>
            <ul class="flex grid lg:grid-cols-2 py-2 mb-12">
                @foreach($randomFacemarks as $facemark)
                    <li class="py-2 px-1 border-b">
                        {{ $facemark->data }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
@include('layouts.footer')

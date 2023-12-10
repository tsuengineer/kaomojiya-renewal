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

            <div class="flex justify-between items-center mt-12">
                <h1 class="p-2 text-lg md:text-xl font-bold">{{ $facemark->data }}</h1>
            </div>
        </div>
    </div>
@endsection
@include('layouts.footer')

@extends('layouts.common')
@include('layouts.header')
@section('title')@yield('title-guest')｜{{ config('app.name') }}@endsection

@section('content')
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
@endsection
@include('layouts.footer')

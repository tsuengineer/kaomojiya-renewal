@extends('layouts.common')
@include('layouts.header')
@section('title')404｜{{ config('app.name') }}@endsection

@section('content')
    <div class="pt-4 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-2 mb-8 text-sm font-medium">
                {{ Breadcrumbs::render('errors.404') }}
            </div>

            <div class="bg-white overflow-hidden">
                {{ __('messages.error_page_404') }}
            </div>
        </div>
    </div>
@endsection
@include('layouts.footer')

@extends('layouts.common')
@include('layouts.header')
@section('title')
    {{ __('title.search_results') }}｜{{ config('app.name') }}
@endsection

@section('content')
    <div class="pt-4 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-2 mb-8 text-sm font-medium">
                {{ Breadcrumbs::render('search') }}
            </div>

            <div class="max-w-7xl mx-auto">
                <h1 class="px-2 font-bold">{{ __('title.search_results') }}</h1>

                <div class="my-2 p-2 bg-gray-100 rounded-lg">
                    <h2 class="px-2 font-bold">{{ __('messages.search_requirements') }}</h2>
                    <form class="p-2" action="{{ route('search.index') }}" method="GET">
                        <div class="flex flex-col pb-2">
                            <label class="">{{ __('messages.keyword') }}:</label>
                            <x-text-input class=" p-1 border rounded-md" type="text" name="keyword" value="{{ $searchData['keyword'] ?? '' }}"></x-text-input>
                        </div>
                        <div class="flex flex-col pb-2">
                            <label>{{ __('messages.tag') }}:</label>
                            <x-text-input class="p-1 border rounded-md" type="text" name="tag"
                                          value="{{ (!in_array($searchData['tag'] ?? '', config('tag.default'))) ? $searchData['tag'] : '' }}">
                            </x-text-input>
                        </div>
                        <div class="flex flex-col pb-2">
                            <label class="">{{ __('messages.sort') }}:</label>
                            <select class="p-1 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md" name="order">
                                <option value="desc" {{ ($searchData['order'] ?? '') !== 'asc' ? 'selected' : '' }}>{{ __('messages.sort_asc') }}</option>
                                <option value="asc" {{ ($searchData['order'] ?? '') === 'asc' ? 'selected' : '' }}>{{ __('messages.sort_desc') }}</option>
                            </select>
                        </div>
                        <div class="pt-2">
                            <x-primary-button type="submit">
                                {{ __('messages.search') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                @if (count($facemarks) !== 0)
                    <div class="my-4">
                        {{ $facemarks->appends(['keyword' => $searchData['keyword'], 'tag' => $searchData['tag'], 'order' => $searchData['order']])->links() }}
                    </div>
                    <ul class="flex grid lg:grid-cols-2 mb-12">
                        @foreach($facemarks as $facemark)
                            <li class="py-2 px-1 border-b">
                                <x-molecules.facemark-item :facemark="$facemark"></x-molecules.facemark-item>
                            </li>
                        @endforeach
                    </ul>
                    <div class="my-4">
                        {{ $facemarks->appends(['keyword' => $searchData['keyword'], 'tag' => $searchData['tag'], 'order' => $searchData['order']])->links() }}
                    </div>
                @else
                    <p class="p-2">{{ __('messages.no_results') }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@include('layouts.footer')

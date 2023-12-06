@extends('layouts.common')
@include('layouts.header')
@section('title')
    {{ __('title.post_facemark') }}｜{{ config('app.name') }}
@endsection

@section('content')
    <div class="pt-4 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-2 mb-8 text-sm font-medium">
                {{ Breadcrumbs::render('create') }}
            </div>

            @if (count($errors) > 0)
                <x-molecules.messages.aside type="error" class="mb-4 mx-2 sm:mx-0">
                    {{ __('messages.error_general') }}
                </x-molecules.messages.aside>
            @endif

            @if (!is_null(session('success')))
                <x-molecules.messages.aside type="info" class="mb-4 mx-2 sm:mx-0">
                    {{ session('success') }}
                </x-molecules.messages.aside>
            @endif


            <form id="postUpload" method="POST" action="{{ route('facemarks.store') }}" enctype="multipart/form-data"  class="px-2 sm:px-0">
                @csrf

                <div class="grid sm:grid-cols-2 grid-cols-1 grid-auto-rows gap-4 pb-6">
                    <div class="sm:col-span-2">
                        <x-input-label for="data" :value="__('messages.facemark')" />
                        <x-text-input id="data" name="data" type="text" class="mt-1 block w-full" :value="old('data')" placeholder="(^^)/" maxlength="255" autocomplete="data" />
                        <x-input-error class="mt-2" :messages="$errors->get('data')" />
                    </div>

                    @for($i = 0; $i < 10; $i++)
                        <div class="tag-input" @if($i > 0) style="display:none" @endif>
                            <x-input-label for="tag-input-{{ $i }}"
                                           :value="$i === 0 ? __('messages.tag') . '(' . __('messages.input_tag_description') . ')' : __('messages.tag') . ($i + 1)" />
                            <x-text-input id="tag-input-{{ $i }}" name="tags[]" type="text" class="mt-1 block w-full" :value="old('tags.'.$i)" maxlength="20" :placeholder="__('messages.greeting')" autocomplete="description"/>
                            <x-input-error class="mt-2" :messages="$errors->get('tags.*')" />
                        </div>
                    @endfor
                </div>

                <x-primary-button>
                    {{ __('messages.post_submit') }}
                </x-primary-button>
            </form>
        </div>
    </div>
    <script>
        // タグの初期表示
        const tagInputs = document.querySelectorAll('.tag-input');
        let tagCount = null;
        for (let i = 0; i < tagInputs.length; i++) {
            const tagInput = tagInputs[i];
            const input = tagInput.querySelector('input');
            if (input.value !== '') {
                tagCount = i;
            }
        }
        if(tagCount !== null) {
            for (let i = 0; i <= tagCount; i++) {
                const tagInput = tagInputs[i + 1];
                tagInput.style.display = 'inline-block';
            }
        }
        // 最初の入力フォームに入力がある場合、次の入力フォームを表示する
        tagInputs.forEach((tagInput, index) => {
            tagInput.addEventListener('input', () => {
                if(index < tagInputs.length - 1 && tagInput.querySelector('input').value !== '') {
                    tagInputs[index + 1].style.display = 'inline-block';
                    tagCount++;
                }
            });
        });

        // エンターでsubmitが発火しないようにする
        const form = document.getElementById('postUpload');
        form.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' && event.target.type !== 'textarea') {
                event.preventDefault();
            }
        });
    </script>
@endsection
@include('layouts.footer')

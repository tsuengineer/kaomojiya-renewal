<div>
    <div class="flex justify-between items-center">
        <h1 class="font-bold">{{ __('messages.posted_facemark') }}</h1>
        @if(count($user->facemarks) > 0)
            <a href="#" class="underline">
                {{ __('anchor.view_more') }}
            </a>
        @endif
    </div>

    @if(count($user->facemarks) > 0)
        <ul>
            @foreach($user->facemarks as $facemark)
                <li class="py-2 px-1 mr-2 border-b">
                    <x-molecules.facemark-item :facemark="$facemark"></x-molecules.facemark-item>
                </li>
            @endforeach
        </ul>
    @else
        <div>{{ __('messages.no_posts') }}</div>
    @endif
</div>

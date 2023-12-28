<div class="pb-8">
    <div class="flex justify-between items-center">
        <h1 class="font-bold">
            @if ($prefix === 'post')
                {{ __('messages.posted_facemark') }}
            @elseif ($prefix === 'favorite')
                {{ __('messages.favorite_facemark') }}
            @endif
        </h1>
        @if(count($facemarks) > 0)
            <a href="#" class="underline">
                {{ __('anchor.view_more') }}
            </a>
        @endif
    </div>

    @if(count($facemarks) > 0)
        <ul>
            @foreach($facemarks as $facemark)
                <li class="py-2 px-1 mr-2 border-b">
                    <x-molecules.facemark-item :facemark="$facemark" :prefix="$prefix"></x-molecules.facemark-item>
                </li>
            @endforeach
        </ul>
    @else
        <div>{{ __('messages.no_posts') }}</div>
    @endif
</div>

<ul class="flex flex-wrap">
    @foreach(config('tag.default') as $tag)
        <li class="tag mt-1 mr-4 mb-3 font-medium text-sm leading-loose cursor-pointer">
            <a href="{{ route('search.index', ['tag' => $tag]) }}" class="rounded-lg bg-gray-200 border-gray-800 bg-white py-1 px-2">
                {{ __('anchor.' . $tag ) }}
            </a>
        </li>
    @endforeach
</ul>

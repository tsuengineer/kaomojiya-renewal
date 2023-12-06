@if (count($breadcrumbs))
    <nav class="breadcrumb">
        <ol class="list-none flex p-0">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb->url }}" class="text-blue-700">{{ $breadcrumb->title }}</a>
                        <span class="mx-1" aria-hidden="true">></span>
                    </li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif

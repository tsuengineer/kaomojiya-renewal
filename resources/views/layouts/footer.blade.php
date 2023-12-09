@section('footer')
    <div class="container m-auto pt-4 pb-12 text-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex">
                <ul>
                    <li>
                        <a href="/about">
                            {{ __('anchor.about') }}
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/kaomojiyacon" target="_blank">
                            {{ __('anchor.twitter') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-4 text-center">
            (C) 2003 - {{now()->year}} {{ __('messages.site_name') }}
        </div>
    </div>
@endsection

@section('header')
    <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex w-full">
                    <!-- Logo -->
                    <div class="shrink-0 flex">
                        <a href="{{ route('top.index') }}" class="flex items-center">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            <div class="pl-2 text-lg font-bold">
                                {{ __('messages.site_name') }}
                            </div>
                        </a>
                    </div>

                    <!-- Search -->
                    <div class="w-full hidden sm:flex sm:-my-px ml-6">
                        <x-atoms.search-form></x-atoms.search-form>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                        <div class="pr-2 whitespace-nowrap">
                            <a href="{{ route('facemarks.create') }}">
                                <x-primary-button>
                                    {{ __('messages.post_facemark_button') }}
                                </x-primary-button>
                            </a>
                        </div>

                        <x-dropdown align="right">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 w-16 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <x-atoms.avatar :user="Auth::user()" type="header"></x-atoms.avatar>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('users.show', Auth::user()->slug)">
                                    {{ __('anchor.my_page') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Edit Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <div class="w-36">
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Login') }}</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Register') }}</a>
                            @endif
                        </div>
                    @endauth
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-2 pb-3 space-y-1 bg-gray-50">
                <x-responsive-nav-link :href="route('top.index')" :active="request()->routeIs('top.index')">
                    {{ __('title.top_page') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                    {{ __('title.users') }}
                </x-responsive-nav-link>
                @auth
                    <x-responsive-nav-link :href="route('facemarks.create')" :active="request()->routeIs('facemarks.create')">
                        {{ __('title.post_facemark') }}
                    </x-responsive-nav-link>
                @endauth
            </div>

            <!-- Responsive Settings Options -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4 pb-1 border-t border-gray-200 bg-gray-50">
                <div class="mt-3 space-y-1">
                    @auth
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Edit Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    @else
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Login') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
@endsection

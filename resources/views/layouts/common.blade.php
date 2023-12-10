<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ __('messages.meta_description') }}">

    <title>@yield('title')</title>

    <!-- OGP -->
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="{{ __('messages.meta_description') }}" />
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://kaomojiya.com" />
    <meta property="og:image" content="https://kaomojiya.com/@yield('ogPath', '')" />
    <meta property="og:site_name" content="{{ __('messages.site_name') }}" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@kaomojiyacom" />
    <meta name="twitter:domain" content="kaomojiya.com" />
    <meta name="twitter:image" content="https://kaomojiya.com/@yield('ogPath', '')" />
    <meta property="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="{{ __('messages.meta_description') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- SweetAlert2 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="@yield('body-id', '')">
<header id="header">
    @yield('header')
</header>
<div class="content" style="min-height: calc(100vh - 200px)">
    @yield('content')
</div>
<footer id="footer" style="background-color: #2d3238;">
    @yield('footer')
</footer>
</body>
</html>


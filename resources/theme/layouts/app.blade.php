<!doctype html>
<html
    lang="{{ app()->getLocale() }}"
    dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ config('app.name') }} |
        @yield('title', 'Home')
    </title>
    <link rel="icon" href="{{ asset("theme/img/logo-dark.png") }}">
    <meta property="og:image" content="{{ asset("theme/img/cover.jpg") }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    @vite("resources/css/app.scss", "vendor/shadow/build")
    @vite("resources/js/app.js", "vendor/shadow/build")
    @if (app()->isLocale('ar'))
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" />
        <style>
            body {
                font-family: 'Tajawal', sans-serif !important;
            }
        </style>
    @endif
    @stack('styles')

</head>
<body x-data="darkMode" data-theme="{{ config('shadow.default_theme') }}" class="min-h-screen bg-background-light font-display text-slate-800 dark:bg-background-dark dark:text-white">
<div class="relative flex min-h-screen w-full flex-col bg-background-light dark:bg-background-dark">
    @include("layouts.partials.navbar")

    <main class="flex flex-1 flex-col">
        @yield('content')
    </main>

    @include("layouts.partials.footer")
</div>
@include("layouts.partials.toast")
@stack('scripts')
</body>
</html>

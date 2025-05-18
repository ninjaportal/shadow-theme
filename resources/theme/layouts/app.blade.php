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
    @vite("resources/css/app.scss", "vendor/shadow/build")
    @vite("resources/js/app.js", "vendor/shadow/build")
    @if (app()->isLocale('ar'))
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" />
        <style>
            body {
                font-family: 'Tajawal', sans-serif;
            }
        </style>
    @endif
    @stack('styles')

</head>
<body x-data="darkMode" data-theme="{{ config("shadow.default_theme") }}">
@include("layouts.partials.navbar")

@yield('content')

@include("layouts.partials.footer")
@include("layouts.partials.toast")
@stack('scripts')
</body>
</html>

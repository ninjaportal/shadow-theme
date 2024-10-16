@php
    use NinjaPortal\Portal\Models\Menu;$menu = [];
    if (class_exists(Menu::class)) {
        $menu = Menu::slug('navbar');
        $menu = $menu->items ?? [];
    }
@endphp


<header
    class="shadow dark:bg-gray-800 dark:text-gray-200"
    x-data="{ open: false }"
>
    <div class="navbar">
        <nav class="nav-wrapper" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5 dark:hidden py-2">
                    <span class="sr-only">Your Company</span>
                    <img class="h-12 w-auto"
                         src="{{ asset('theme/img/logo.png') }}" alt="">
                </a>
                <a href="/" class="-m-1.5 p-1.5 hidden dark:block">
                    <span class="sr-only">Your Company</span>
                    <img class="h-12 w-auto"
                         src="{{ asset('theme/img/logo-dark.png') }}" alt="">
                </a>
            </div>
            <div class="wrapper flex items-center space-x-2">
                <div class="nav-items">
                    @foreach($menu as $item)
                        <a href="{{ $item->route ? route($item->route) :  $item->url }}"
                           class="mx-1 hover:text-primary">
                            {{ $item->title }}
                        </a>
                    @endforeach
                    @guest()
                        <div class="links">
                            <a href="{{ route('login') }}"
                               class="mx-4 hover:text-primary">
                                @lang("shadow::shadow.login")
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                @lang("shadow::shadow.register")
                            </a>
                        </div>
                    @endguest
                    @auth()
                        @include('layouts.partials.usermenu')
                    @endauth
                </div>
                <div class="flex lg:hidden">
                    <button
                        @click="open = !open"
                        type="button"
                        class="open-menu-btn -m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 dark:text-gray-200">
                        <x-heroicon-o-bars-3 class="h-6 w-6"/>
                    </button>
                </div>

                @if (count(config('shadow.locales',[])) > 1)
                    @include("layouts.partials.lang-switcher")
                @endif
                @if(config('shadow.darkmode_enabled'))
                    <button @click="toggleDarkMode()" class="btn btn-link">
                        <x-heroicon-o-moon x-show="!dark" class="h-6 w-6"/>
                        <x-heroicon-o-sun class="h-6 w-6" x-show="dark"/>
                    </button>
                @endif
            </div>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div class="lg:hidden" id="mobile-menu" x-show="open">
        <div class="space-y-1 px-2 pb-3 pt-2">
            @foreach($menu as $item)
                <a href="{{ $item->route ? route($item->route) :  $item->url }}"
                   class="mx-1 hover:text-primary">
                    {{ $item->title }}
                </a>
            @endforeach
            @guest()
                <div class="links">
                    <a href="{{ route('login') }}"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-primary">
                        @lang("shadow::shadow.login")
                    </a>
                    <a href="{{ route('register') }}"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-primary">
                        @lang("shadow::shadow.register")
                    </a>
                </div>
            @endguest
        </div>
    </div>

</header>

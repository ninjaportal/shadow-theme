@php
    use NinjaPortal\Portal\Models\Menu;

    $menuItems = [];
    if (class_exists(Menu::class)) {
        $menu = Menu::slug('navbar');
        $menuItems = $menu->items ?? [];
    }
@endphp

<header
    class="fixed inset-x-0 top-0 z-50 border-b border-slate-200 bg-white/90 px-4 py-4 backdrop-blur-md transition-colors dark:border-border-dark/70 dark:bg-background-dark/95"
    x-data="{ open: false }"
>
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-6">
        <a href="/" class="flex items-center gap-3 text-slate-900 dark:text-white">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/15 text-primary">
                <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                    <path clip-rule="evenodd" d="M24 4H42V17.3333V30.6667H24V44H6V30.6667V17.3333H24V4Z" fill="currentColor" fill-rule="evenodd"/>
                </svg>
            </span>
            <span class="text-lg font-bold tracking-tight">{{ config('app.name') }}</span>
        </a>

        <div class="hidden flex-1 items-center justify-end gap-10 md:flex">
            <nav class="flex items-center gap-8 text-sm font-medium text-slate-600 dark:text-white/60">
                @foreach($menuItems as $item)
                    <a href="{{ $item->route ? route($item->route) : $item->url }}"
                       class="transition-colors hover:text-slate-900 dark:hover:text-white">
                        {{ $item->title }}
                    </a>
                @endforeach
            </nav>
            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}"
                       class="text-sm font-medium text-slate-600 transition-colors hover:text-slate-900 dark:text-white/70 dark:hover:text-white">
                        @lang('shadow::shadow.login')
                    </a>
                    <a href="{{ route('register') }}"
                       class="flex min-w-[110px] items-center justify-center rounded-full bg-primary px-5 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/30 transition hover:bg-primary/80">
                        {{ __('shadow::shadow.get_api_key') }}
                    </a>
                @else
                    @include('layouts.partials.usermenu')
                @endguest

                @if (count(config('shadow.locales',[])) > 1)
                    @include('layouts.partials.lang-switcher')
                @endif

                @if(config('shadow.darkmode_enabled'))
                    <button @click="toggleDarkMode()" class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:text-slate-900 dark:border-border-dark/70 dark:text-white/70 dark:hover:text-white">
                        <x-heroicon-o-moon x-show="!dark" class="h-5 w-5"/>
                        <x-heroicon-o-sun class="h-5 w-5" x-show="dark"/>
                    </button>
                @endif
            </div>
        </div>

        <button
            @click="open = !open"
            type="button"
            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-700 transition hover:border-primary/50 hover:text-primary dark:border-border-dark/70 dark:text-white md:hidden"
            aria-label="Toggle navigation"
        >
            <span class="material-symbols-outlined" x-show="!open">menu</span>
            <span class="material-symbols-outlined" x-show="open">close</span>
        </button>
    </div>

    <nav
        class="md:hidden"
        x-show="open"
        x-transition.origin.top
        style="display: none;"
    >
        <div class="mt-3 space-y-2 rounded-xl border border-slate-200 bg-white p-4 shadow-xl shadow-black/10 dark:border-border-dark dark:bg-surface-dark dark:shadow-2xl dark:shadow-black/40">
            @foreach($menuItems as $item)
                <a href="{{ $item->route ? route($item->route) : $item->url }}"
                   class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-white/70 dark:hover:bg-white/5 dark:hover:text-white">
                    {{ $item->title }}
                </a>
            @endforeach

            @guest
                <a href="{{ route('login') }}"
                   class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-white/70 dark:hover:bg-white/5 dark:hover:text-white">
                    @lang('shadow::shadow.login')
                </a>
                <a href="{{ route('register') }}"
                   class="block rounded-lg bg-primary px-3 py-2 text-center text-sm font-semibold text-white shadow shadow-primary/20 transition hover:bg-primary/80">
                    {{ __('shadow::shadow.get_api_key') }}
                </a>
            @else
                <div class="flex flex-col gap-2">
                    <a href="{{ route('apps.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-white/70 dark:hover:bg-white/5 dark:hover:text-white">
                        @lang('shadow::shadow.apps')
                    </a>
                    <a href="{{ route('profile') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-white/70 dark:hover:bg-white/5 dark:hover:text-white">
                        @lang('shadow::shadow.profile')
                    </a>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-white/70 dark:hover:bg-white/5 dark:hover:text-white">
                            @lang('shadow::shadow.logout')
                        </button>
                    </form>
                </div>
            @endguest

            @if (count(config('shadow.locales',[])) > 1)
                <div class="border-t border-slate-200 pt-3 dark:border-border-dark/70">
                    <div class="flex flex-wrap gap-2">
                        @foreach(config('shadow.locales',[]) as $key => $locale)
                            <a href="{{ route('lang.change', $key) }}" class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 transition hover:bg-slate-200 hover:text-slate-900 dark:bg-white/5 dark:text-white/80 dark:hover:bg-white/10 dark:hover:text-white">
                                {{ $locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </nav>
</header>

<div class="h-20 md:h-24"></div>

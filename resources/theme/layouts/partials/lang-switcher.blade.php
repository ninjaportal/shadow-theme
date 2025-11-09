<!-- Profile dropdown -->
<div
    x-data="dropdown"
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
    class="relative"
>
    <button
        x-ref="button"
        x-on:click="toggle()"
        :aria-expanded="open"
        type="button"
        class="flex items-center gap-1 rounded-full border border-slate-200 bg-transparent px-3 py-2 text-sm font-medium text-slate-600 transition hover:text-slate-900 dark:border-border-dark/70 dark:text-white/70 dark:hover:text-white"
    >
        <span class="material-symbols-outlined text-lg">language</span>
        <span class="uppercase">{{ app()->getLocale() }}</span>
        <span class="material-symbols-outlined text-base">expand_more</span>
    </button>

    <div
        x-ref="panel"
        x-show="open"
        x-transition.origin.top.right
        x-on:click.outside="close($refs.button)"
        :id="$id('dropdown-button')"
        style="display: none;"
    class="absolute right-0 z-50 mt-3 w-44 rounded-xl border border-slate-200 bg-white p-2 shadow-xl shadow-black/10 dark:border-border-dark dark:bg-surface-dark dark:shadow-2xl dark:shadow-black/40"
        role="menu"
        id="user-dropdown"
        tabindex="-1">
        @foreach(config('shadow.locales',[]) as $key => $locale)
                <a href="{{ route('lang.change', $key) }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-white/70 dark:hover:bg-white/5 dark:hover:text-white">
                {{ $locale }}
            </a>
        @endforeach
    </div>
</div>

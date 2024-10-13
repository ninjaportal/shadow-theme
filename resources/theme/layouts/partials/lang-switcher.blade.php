<!-- Profile dropdown -->
<div
    x-data="dropdown"
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
    class="user-menu lang-switcher">
    <button
        x-ref="button"
        x-on:click="toggle()"
        :aria-expanded="open"
        type="button"
        class="btn btn-link">
        <x-heroicon-o-language class="h-6 w-6" />
    </button>

    <div
        x-ref="panel"
        x-show="open"
        x-transition.origin.top.left
        x-on:click.outside="close($refs.button)"
        :id="$id('dropdown-button')"
        style="display: none;"
        class="user-dropdown"
        role="menu"
        id="user-dropdown"
        tabindex="-1">
        @foreach(config("shadow.locales",[]) as $key => $locale)
            <a href="{{ route("lang.change", $key) }}" class="user-dropdown-item">
                {{ $locale }}
            </a>
        @endforeach
    </div>
</div>

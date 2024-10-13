<!-- Profile dropdown -->
<div
    x-data="dropdown"
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
    class="user-menu">
    <button
        x-ref="button"
        x-on:click="toggle()"
        :aria-expanded="open"
        type="button"
        class="dropdown-btn user-btn">
        <span class="bg-primary text-white text-lg font-semibold p-2 px-3 bg-gray-800 rounded-full">
            {{ auth()->user()->first_name[0].auth()->user()->last_name[0] }}
        </span>
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
        <!-- Active: "bg-gray-100", Not Active: "" -->

        <a href="{{ route("apps.index") }}" class="user-dropdown-item">@lang("shadow::shadow.apps")</a>
        <a href="{{ route('profile') }}">@lang('shadow::shadow.profile')</a>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="hidden"></button>
            <a
                onclick="event.preventDefault(); this.closest('form').submit();"
                class="user-dropdown-item cursor-pointer">@lang("shadow::shadow.logout")</a>
        </form>
    </div>
</div>

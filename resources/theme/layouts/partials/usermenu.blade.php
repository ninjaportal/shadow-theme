<!-- Profile dropdown -->
@php
    $user = auth()->user();
    $initials = collect([$user?->first_name, $user?->last_name])
        ->filter()
        ->map(fn ($value) => mb_substr($value, 0, 1))
        ->join('');
    if ($initials === '' && $user?->email) {
        $initials = strtoupper(mb_substr($user->email, 0, 1));
    }
@endphp

<div
    x-data="dropdown"
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
    class="user-menu"
>
    <button
        x-ref="button"
        x-on:click="toggle()"
        :aria-expanded="open"
        type="button"
        class="user-btn h-10 w-10 items-center justify-center"
    >
        <span class="text-sm font-semibold uppercase">{{ $initials }}</span>
    </button>

    <div
        x-ref="panel"
        x-show="open"
        x-transition.origin.top.right
        x-on:click.outside="close($refs.button)"
        :id="$id('dropdown-button')"
        style="display: none;"
        class="user-dropdown"
        role="menu"
        id="user-dropdown"
        tabindex="-1">
        <a href="{{ route('apps.index') }}" class="user-dropdown-item">@lang('shadow::shadow.apps')</a>
        <a href="{{ route('profile') }}" class="user-dropdown-item">@lang('shadow::shadow.profile')</a>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="hidden"></button>
            <a
                onclick="event.preventDefault(); this.closest('form').submit();"
                class="user-dropdown-item cursor-pointer">@lang('shadow::shadow.logout')</a>
        </form>
    </div>
</div>

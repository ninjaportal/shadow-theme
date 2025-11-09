@extends('layouts.app')

@section("title", __("shadow.apps"))

@section("content")
    @component('components.title', ["breadcrumbs"=>[
        [
            'name' => __('shadow::shadow.home'),
            'url' => route('home')
        ],
        [
            'name' => __('shadow::shadow.apps'),
            'url' => route('apps.index')
        ],
    ]])
        @slot('title')
            {{ __("shadow::shadow.apps") }}
        @endslot
        <div class="mt-6 lg:mt-0 lg:flex lg:space-x-6">
            <a href="{{ route("apps.create") }}" class="btn btn-primary text-white">
                @lang("shadow::shadow.new_app")
            </a>
        </div>
    @endcomponent


    <div class="mx-auto w-full max-w-7xl px-6 py-14">
        <div class="grid w-full grid-cols-1 gap-6">
            @forelse($apps as $app)
                <article class="w-full rounded-2xl border border-slate-200 bg-white p-6 shadow-lg shadow-black/5 transition hover:-translate-y-1 hover:shadow-xl dark:border-border-dark/70 dark:bg-surface-dark dark:text-white">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-3 text-base font-semibold leading-7 text-slate-900 dark:text-white">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <x-heroicon-o-cog-6-tooth class="h-5 w-5" />
                            </span>
                            <span>{{ $app->getDisplayName() ?? $app->getName() }}</span>
                        </div>
                        <nav class="flex flex-wrap items-center gap-3 text-sm font-medium">
                            <a href="{{ route("apps.show", $app->getName()) }}" class="text-slate-600 transition hover:text-primary dark:text-white/70 dark:hover:text-primary" data-testid="apps-view-link">
                                @lang("shadow::shadow.view")
                            </a>
                            <span class="hidden h-3 w-px bg-slate-200 dark:bg-border-dark/70 sm:block" aria-hidden="true"></span>
                            <a href="{{ route("apps.edit", $app->getName()) }}" class="text-blue-600 transition hover:text-blue-700 dark:text-blue-300 dark:hover:text-blue-200">
                                @lang("shadow::shadow.edit")
                            </a>
                            <span class="hidden h-3 w-px bg-slate-200 dark:bg-border-dark/70 sm:block" aria-hidden="true"></span>
                            <x-shadow::action-confirm-modal
                                :method="'DELETE'"
                                trigger-class="text-red-600 transition hover:text-red-700 dark:text-red-300 dark:hover:text-red-200"
                                :action="route('apps.destroy', $app->getName())"
                                :trigger="__('shadow::shadow.delete')"  />
                        </nav>
                    </div>
                </article>
            @empty
                @include('components.noitems')
            @endforelse
        </div>
    </div>

@endsection

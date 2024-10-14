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


    <div class="mx-auto max-w-7xl px-6 py-14">
        <div class="grid grid-cols-1 gap-6">
            @foreach($apps as $app)
                <div class="flex flex-col dark:bg-gray-700 p-6 shadow-lg">
                    <dt class="flex items-center justify-between text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center">
                            <x-heroicon-o-cog-6-tooth class="h-6 w-6 text-white mr-2" />
                            {{ $app->getDisplayName() ?? $app->getName() }}
                        </div>
                        <div class="actions">
                            <a href="{{ route("apps.show", $app->getName()) }}"
                               class="px-2 text-gray-700 dark:text-gray-300 hover:text-primary/90 dark:hover:text-primary/70 duration-300">
                                @lang("shadow::shadow.view")
                            </a>
                            <a href="{{ route("apps.edit", $app->getName()) }}"
                               class="px-2 text-blue-700 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-400 duration-300">
                                @lang("shadow::shadow.edit")
                            </a>
                            <x-shadow::action-confirm-modal
                                :method="'DELETE'"
                                trigger-class="px-2 text-red-700 dark:text-red-300 hover:text-red-800 dark:hover:text-red-400 duration-300"
                                :action="route('apps.destroy', $app->getName())"
                                :trigger="__('shadow::shadow.delete')"  />
                        </div>
                    </dt>
                </div>
            @endforeach
        </div>
    </div>

@endsection

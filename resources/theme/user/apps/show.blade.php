@php
    $name = $app->getDisplayName() ?? $app->getName();
@endphp

@extends('layouts.app')

@section("title", $name)


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
        [
            'name' => $name,
            'url' => route('apps.show', $app->getName())
        ],
    ]])
        @slot('title')
            {{ $name }}
        @endslot
        <div class="mt-6 lg:mt-0 lg:flex lg:space-x-6">
            <a href="{{ route('apps.edit', $app->getName()) }}" class="btn btn-primary text-white">
                @lang('shadow::shadow.edit_app')
            </a>
        </div>
    @endcomponent

    <div class="mx-auto w-full max-w-7xl px-6 py-14">
        <section class="w-full rounded-2xl border border-slate-200 bg-white p-8 shadow-lg shadow-black/5 dark:border-border-dark/70 dark:bg-surface-dark">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-3xl">
                @lang('shadow::shadow.app_details')
            </h1>
            <dl class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="rounded-xl bg-slate-50 p-4 dark:bg-white/5">
                    <dt class="flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-white/70">
                        <x-heroicon-o-bars-3-bottom-left class="h-5 w-5" />
                        @lang("shadow::shadow.app_name")
                    </dt>
                    <dd class="mt-2 text-base font-medium text-slate-900 dark:text-white">{{ $app->getName() }}</dd>
                </div>
                <div class="rounded-xl bg-slate-50 p-4 dark:bg-white/5">
                    <dt class="flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-white/70">
                        <x-heroicon-o-bars-3-bottom-left class="h-5 w-5" />
                        @lang("shadow::shadow.app_display_name")
                    </dt>
                    <dd class="mt-2 text-base font-medium text-slate-900 dark:text-white">{{ $app->getDisplayName() }}</dd>
                </div>
                <div class="rounded-xl bg-slate-50 p-4 dark:bg-white/5 sm:col-span-2">
                    <dt class="flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-white/70">
                        <x-heroicon-o-bars-3-bottom-left class="h-5 w-5" />
                        @lang("shadow::shadow.app_description")
                    </dt>
                    <dd class="mt-2 text-base font-medium text-slate-900 dark:text-white">{{ $app->getDescription() }}</dd>
                </div>
                <div class="rounded-xl bg-slate-50 p-4 dark:bg-white/5">
                    <dt class="flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-white/70">
                        <x-heroicon-o-link class="h-5 w-5" />
                        @lang("shadow::shadow.callback_url")
                    </dt>
                    <dd class="mt-2 text-base font-medium text-slate-900 dark:text-white">{{ $app->getCallbackUrl() }}</dd>
                </div>
                <div class="rounded-xl bg-slate-50 p-4 dark:bg-white/5">
                    <dt class="flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-white/70">
                        <x-heroicon-o-check-circle class="h-5 w-5" />
                        @lang("shadow::shadow.status")
                    </dt>
                    <dd class="mt-2 text-base font-medium text-slate-900 dark:text-white">{{ $app->getStatus() }}</dd>
                </div>
                <div class="rounded-xl bg-slate-50 p-4 dark:bg-white/5">
                    <dt class="flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-white/70">
                        <x-heroicon-o-clock class="h-5 w-5" />
                        @lang("shadow::shadow.created_at")
                    </dt>
                    <dd class="mt-2 text-base font-medium text-slate-900 dark:text-white">{{ $app->getCreatedAt() }}</dd>
                </div>
            </dl>
        </section>

        <section class="mt-10 w-full rounded-2xl border border-slate-200 bg-white p-8 shadow-lg shadow-black/5 dark:border-border-dark/70 dark:bg-surface-dark">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-3xl">
                    @lang('shadow::shadow.app_keys')
                </h2>
                @if (count($app->getCredentials()) < config('shadow.keys_per_app'))
                    <x-shadow::model
                        trigger-class="btn btn-primary text-white"
                        :title="__('shadow::shadow.create_key')"
                        :trigger="__('shadow::shadow.create_key')"
                    >
                        <div class="mt-4">
                            {{ $newKeyForm->render() }}
                        </div>
                    </x-shadow::model>
                @endif
            </div>

            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2" data-testid="app-keys">
                @forelse($app->getCredentials() as $key)
                    <article class="flex w-full flex-col gap-5 rounded-2xl bg-slate-50 p-6 dark:bg-white/5">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-white/60">
                                    @lang("shadow::shadow.issued_at")
                                </p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">{{ $key->getIssuedAt() }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-white/60">
                                    @lang("shadow::shadow.expires_at")
                                </p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">{{ $key->getExpiresAt() ? $key->getExpiresAt() : __('shadow::shadow.never') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-white/60">
                                    @lang("shadow::shadow.status")
                                </p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">{{ $key->getStatus() }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-white/60">
                                    @lang("shadow::shadow.products")
                                </p>
                                <ul class="mt-1 space-y-1 text-sm text-slate-900 dark:text-white">
                                    @foreach($key->getApiProducts() as $product)
                                        <li class="flex items-center justify-between gap-3 rounded-lg bg-white/60 px-3 py-2 text-sm font-medium shadow-sm dark:bg-surface-dark/60">
                                            <span>{{ $product['apiproduct'] }}</span>
                                            <span class="text-xs uppercase tracking-wide text-slate-500 dark:text-white/60">{{ $product['status'] }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-white/60">@lang("shadow::shadow.client_id")</span>
                                <input class="input input-bordered input-primary w-full" value="{{ $key->getConsumerKey() }}" readonly type="text">
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-white/60">@lang("shadow::shadow.client_secret")</span>
                                <input class="input input-bordered input-primary w-full" value="{{ $key->getConsumerSecret() }}" readonly type="text">
                            </label>
                        </div>

                        <div class="flex flex-wrap items-center gap-3">
                            <x-shadow::action-confirm-modal
                                trigger-class="btn btn-sm btn-error text-white"
                                :action="route('apps.keys.delete', [$app->getName(), $key->getConsumerKey()])"
                                :method="'DELETE'"
                                :title="__('shadow::shadow.delete')"
                                :trigger="__('shadow::shadow.delete')"
                            />
                            <x-shadow::model
                                :trigger="__('shadow::shadow.add_api_product')"
                                :title="__('shadow::shadow.add_api_product')"
                                trigger-class="btn btn-sm btn-primary text-white"
                            >
                                @php
                                    $added_products = collect($key->getApiProducts())->pluck('apiproduct','apiproduct')->toArray();
                                    $form = \NinjaPortal\Shadow\Former\Former::make([
                                        \NinjaPortal\Shadow\Former\Fields\MultiSelect::make('api_products')
                                            ->setOptions($products)->setValue($added_products)
                                    ])->setAction(route('apps.keys.add-product', [$app->getName(), $key->getConsumerKey()]));
                                @endphp
                                {{ $form->render() }}
                            </x-shadow::model>
                            <x-shadow::model
                                :trigger="__('shadow::shadow.remove_api_product')"
                                :title="__('shadow::shadow.remove_api_product')"
                                trigger-class="btn btn-sm btn-primary text-white"
                            >
                                @php
                                    $added_products = collect($key->getApiProducts())->pluck('apiproduct','apiproduct')->toArray();
                                    $form = \NinjaPortal\Shadow\Former\Former::make([
                                        \NinjaPortal\Shadow\Former\Fields\SelectInput::make('api_product')
                                            ->setOptions($added_products)
                                    ])->setAction(route('apps.keys.remove-product', [$app->getName(), $key->getConsumerKey()]));
                                @endphp
                                {{ $form->render() }}
                            </x-shadow::model>
                        </div>
                    </article>
                @empty
                    <div class="flex w-full items-center justify-center rounded-2xl bg-slate-50 py-10 text-center text-sm text-slate-500 dark:bg-white/5 dark:text-white/60">
                        @lang('shadow::shadow.no_keys')
                    </div>
                @endforelse
            </div>
        </section>
    </div>

@endsection

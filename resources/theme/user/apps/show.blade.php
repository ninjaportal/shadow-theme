@php
    $apiProductsService = new \NinjaPortal\Portal\Services\ApiProductService();
    $name = $app->getDisplayName() ?? $app->getName();
    $keys_per_app = config('shadow.keys_per_app');
    $my_api_products = $apiProductsService->mine()->pluck('name','apigee_product_id')->toArray();
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

    <div class="mx-auto max-w-7xl px-6 py-14">
        <h1 class="text-2xl tracking-tight text-gray-900 sm:text-3xl dark:text-white mb-4">
            @lang('shadow::shadow.app_details')
        </h1>
        <div class="grid grid-cols-1 ">
            <div class="flex py-1">
                <div class="property-name flex font-bold">
                    <x-heroicon-o-bars-3-bottom-left class="h-6 w-6 text-white mr-2" />
                    @lang("shadow::shadow.app_name")
                </div>
                <div class="property-value px-3">
                    {{ $app->getName() }}
                </div>
            </div>
            <div class="flex py-1">
                <div class="property-name flex font-bold">
                    <x-heroicon-o-bars-3-bottom-left class="h-6 w-6 text-white mr-2" />
                    @lang("shadow::shadow.app_display_name")
                </div>
                <div class="property-value px-3">
                    {{ $app->getDisplayName() }}
                </div>
            </div>
            <div class="flex py-1">
                <div class="property-name flex font-bold">
                    <x-heroicon-o-bars-3-bottom-left class="h-6 w-6 text-white mr-2" />
                    @lang("shadow::shadow.app_description")
                </div>
                <div class="property-value px-3">
                    {{ $app->getDescription() }}
                </div>
            </div>
            <div class="flex py-1">
                <div class="property-name flex font-bold">
                    <x-heroicon-o-link class="h-6 w-6 text-white mr-2" />
                    @lang("shadow::shadow.callback_url")
                </div>
                <div class="property-value px-3">
                    {{ $app->getCallbackUrl() }}
                </div>
            </div>
            <div class="flex py-1">
                <div class="property-name flex font-bold">
                    <x-heroicon-o-check-circle class="h-6 w-6 text-white mr-2" />
                    @lang("shadow::shadow.status")
                </div>
                <div class="property-value px-3">
                    {{ $app->getStatus() }}
                </div>
            </div>
            <div class="flex py-1">
                <div class="property-name flex font-bold">
                    <x-heroicon-o-clock class="h-6 w-6 text-white mr-2" />
                    @lang("shadow::shadow.created_at")
                </div>
                <div class="property-value px-3">
                    {{ $app->getCreatedAt() }}
                </div>
            </div>
        </div>

        <hr class="my-6 border-gray-300 dark:border-gray-700">


        <div class="flex justify-between items-center">
            <h1 class="text-2xl tracking-tight text-gray-900 sm:text-3xl dark:text-white pb-4">
                @lang('shadow::shadow.app_keys')
            </h1>
            @if (count($app->getCredentials()) < $keys_per_app)
            <x-shadow::model
                trigger-class="btn btn-sm btn-primary dark:text-white"
                :title="__('shadow::shadow.create_key')"
                :trigger="__('shadow::shadow.create_key')"
            >
                <div class="mt-4">
                    {{ $newKeyForm->render() }}
                </div>
            </x-shadow::model>
            @endif
        </div>

        <div class="grid grid-cols-1 gap-6 mt-4">
        @forelse($app->getCredentials() as $key)
            <div class="dark:bg-gray-700 p-6">
                <div class="flex py-1">
                    <div class="property-name flex font-bold">
                        <x-heroicon-o-clock class="h-6 w-6 text-white mr-2" />
                        @lang("shadow::shadow.issued_at")
                    </div>
                    <div class="property-value px-3">
                        {{ $key->getIssuedAt() }}
                    </div>
                </div>
                <div class="flex py-1">
                    <div class="property-name flex font-bold">
                        <x-heroicon-o-clock class="h-6 w-6 text-white mr-2" />
                        @lang("shadow::shadow.expires_at")
                    </div>
                    <div class="property-value px-3">
                        {{ $key->getExpiresAt() ? $key->getExpiresAt() : __("shadow.never") }}
                    </div>
                </div>
                <div class="flex py-1">
                    <div class="property-name flex font-bold">
                        <x-heroicon-o-check-circle class="h-6 w-6 text-white mr-2" />
                        @lang("shadow::shadow.status")
                    </div>
                    <div class="property-value px-3">
                        {{ $key->getStatus() }}
                    </div>
                </div>
                <div class="flex flex-col py-1 mt-4">
                    <div class="property-name flex font-bold">
                        <x-heroicon-o-arrows-pointing-out class="h-6 w-6 text-white mr-2" />
                        @lang("shadow::shadow.products")
                    </div>
                    <div class="property-value mt-2">
                        <div class="grid mx-4">
                            @foreach($key->getApiProducts() as $product)
                                <div class="flex">
                                    <span class="font-bold">
                                    - {{ $product['apiproduct'] }}
                                </span>
                                    <span class="px-3">
                                    {{ $product['status'] }}
                                </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex flex-col py-1 mt-4">
                    <div class="property-name flex font-bold">
                        <x-heroicon-o-key class="h-6 w-6 text-white mr-2" />
                        @lang("shadow::shadow.client_id")
                    </div>
                    <div class="property-value">
                        <input
                            class="input w-full mt-4"
                            value="{{ $key->getConsumerKey() }}"
                            readonly
                            type="text">
                    </div>
                </div>
                <div class="flex flex-col py-1 mt-4">
                    <div class="property-name flex font-bold">
                        <x-heroicon-o-key class="h-6 w-6 text-white mr-2" />
                        @lang("shadow::shadow.client_secret")
                    </div>
                    <div class="property-value">
                        <input
                            class="input w-full mt-4"
                            value="{{ $key->getConsumerSecret() }}"
                            readonly
                            type="text">
                    </div>
                </div>
                <div class="flex space-x-2 mt-4">
                    <x-shadow::action-confirm-modal
                        trigger-class="btn btn-sm btn-error dark:text-white"
                        :action="route('apps.keys.delete', [$app->getName(), $key->getConsumerKey()])"
                        :method="'DELETE'"
                        :title="__('shadow::shadow.delete')"
                        :trigger="__('shadow::shadow.delete')"
                    />
                    <x-shadow::model
                        :trigger="__('shadow::shadow.add_api_product')"
                        :title="__('shadow::shadow.add_api_product')"
                        trigger-class="btn btn-sm btn-primary dark:text-white"
                    >
                        @php
                        $added_products = collect($key->getApiProducts())->pluck('apiproduct','apiproduct')->toArray();
                        $form = \NinjaPortal\Shadow\Former\Former::make([
                            \NinjaPortal\Shadow\Former\Fields\MultiSelect::make('api_products')
                                ->setOptions($my_api_products)->setValue($added_products)
                        ])->setAction(route('apps.keys.add-product', [$app->getName(), $key->getConsumerKey()]));
                        @endphp
                        {{ $form->render() }}
                    </x-shadow::model>
                    <x-shadow::model
                        :trigger="__('shadow::shadow.remove_api_product')"
                        :title="__('shadow::shadow.remove_api_product')"
                        trigger-class="btn btn-sm btn-primary dark:text-white"
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
            </div>
        @empty
            <div class="flex justify-center items-center py-6">
                <p class="text-gray-500 dark:text-gray-400">
                    @lang('shadow::shadow.no_keys')
                </p>
            </div>
        @endforelse

        </div>
    </div>

@endsection

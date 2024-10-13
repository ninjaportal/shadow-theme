@php use Illuminate\Support\Facades\Storage;use NinjaPortal\Portal\Models\ApiProduct; @endphp
@extends("layouts.app")

@section("title", $product->name)

@section("content")
    @component('components.title', ["breadcrumbs"=>[
        [
            'name' => __('shadow::shadow.home'),
            'url' => route('home')
        ],
        [
            'name' => __('shadow::shadow.products'),
            'url' => route('products.index')
        ],
        [
            'name' => $product->name,
            'url' => route('products.show', $product)
        ],
    ]])
        @slot('title')
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-white">
                {{ $product->name }}
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                {{ $product->short_description }}
            </p>
        @endslot
    @endcomponent

    <div class="mx-auto max-w-7xl px-6 py-14 lg:px-8">
        <div class="product_description mb-4">
            {!! $product->description !!}
        </div>
        <x-shadow::swagger-viewer
            :swagger-file="Storage::disk(ApiProduct::$STORAGE_DISK)->url($product->swagger_url)"/>
    </div>

@endsection

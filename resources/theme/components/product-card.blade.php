@props([
    'product' => null,
])

@if ($product)
<div class="flex flex-col dark:bg-gray-700 shadow-lg p-6">
    <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">
        <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-primary">
            <x-heroicon-o-arrows-pointing-out class="h-6 w-6 text-white" />
        </div>
        {{ $product->name }}
    </dt>
    <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
        <p class="flex-auto">
            {{ $product->short_description }}
        </p>
        <p class="mt-6">
            <a href="{{ route("products.show", $product) }}"
               class="text-sm font-semibold leading-6 text-primary">
                Learn more <span aria-hidden="true">→</span>
            </a>
        </p>
    </dd>
</div>
@endif

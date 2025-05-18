@php
    $breadcrumbs = [
        [
            'name' => __('shadow::shadow.home'),
            'url' => route('home')
       ],
       [
           'name' => __('shadow::shadow.products'),
           'url' => route('products.index')
       ],
    ];
@endphp
@extends("layouts.app")
@section("title", __("shadow::shadow.products"))


@section("content")
    @component('components.title', ["breadcrumbs"=>$breadcrumbs])
        @slot('title')
            {{ __("shadow::shadow.products") }}
        @endslot
    @endcomponent

    <div class="mx-auto max-w-7xl px-6 py-14">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($products as $product)
                @component('components.product-card',['product' => $product]) @endcomponent
            @endforeach
        </div>
        @if ($products->isEmpty())
            @include('components.noitems')
        @endif
    </div>


@endsection

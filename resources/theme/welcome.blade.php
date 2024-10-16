@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="bg-white dark:bg-gray-800">
        <div class="relative isolate pt-0">
            <div class="mx-auto max-w-7xl px-6 py-4 sm:py-20 lg:flex-row-reverse lg:flex grid-cols-2 lg:items-center lg:gap-x-10 lg:px-8">
                <div class="mt-16 sm:mt-24 lg:mt-0">
                    <img class="w-full lg:h-auto lg:w-[500px]" alt="Hero image"
                         src="{{ asset('theme/img/hero1.png') }}" />
                </div>
                <div class="mx-auto lg:mx-0 lg:flex-auto">
                    <h1 class="mt-10 max-w-lg text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-gray-100">
                        @lang("Digital Integration is now easier with")
                        <span class="text-primary">{{ config('app.name') }}</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600 line-height-[1.8] dark:text-gray-300">
                        @lang("Get started with our API products and start integrating your applications with ease.")
                    </p>
                    <div class="mt-10 flex items-center gap-x-6">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            @lang("Explore Products")
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-24 sm:py-32 dark:bg-gray-800">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-6xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-gray-100">
                    @lang("Explore our recent API Products")
                </h2>
                <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    @lang("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.")
                </p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    @forelse($products as $product)
                        @component('components.product-card',['product' => $product]) @endcomponent
                    @empty
                        <div class="col-span-3">
                            @include('components.noitems')
                        </div>
                    @endforelse
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-primary/20 dark:bg-primary/70">
        <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:flex lg:items-center lg:justify-between lg:px-8">
            <h2 class="max-w-4xl  text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100 sm:text-3xl">
                @lang("Ready to dive in?")
                <br>
                @lang("Start exploring our API products today.")
            </h2>
            <div class="mt-10 flex items-center gap-x-6 lg:mt-0 lg:flex-shrink-0">
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    @lang("Explore Products")
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800">
        <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24 lg:px-8">
            <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900 dark:text-gray-100">Frequently asked questions</h2>
            <p class="mt-6 max-w-2xl text-base leading-7 text-gray-600 dark:text-gray-300">Have a different question and can’t find the answer you’re looking for? Reach out to our support team by <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">sending us an email</a> and we’ll get back to you as soon as we can.</p>
            <div class="mt-20">
                <dl class="space-y-16 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-16 sm:space-y-0 lg:grid-cols-3 lg:gap-x-10">
                    <div>
                        <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">What&#039;s the best thing about Switzerland?</dt>
                        <dd class="mt-2 text-base leading-7 text-gray-600 dark:text-gray-300">I don&#039;t know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection

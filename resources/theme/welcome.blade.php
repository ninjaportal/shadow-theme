@extends('layouts.app')
@section('title', __('shadow::shadow.home'))

@section('content')
    @php
        $documentationUrl = config('shadow.documentation_url', '#');
        $faqItems = (array) trans('shadow::shadow.faq_items');
        $resourceCards = [
            [
                'icon' => 'description',
                'title' => __('shadow::shadow.resources.api_reference_title'),
                'description' => __('shadow::shadow.resources.api_reference_description'),
                'url' => $documentationUrl,
            ],
            [
                'icon' => 'download',
                'title' => __('shadow::shadow.resources.sdks_title'),
                'description' => __('shadow::shadow.resources.sdks_description'),
                'url' => $documentationUrl,
            ],
            [
                'icon' => 'rocket_launch',
                'title' => __('shadow::shadow.resources.quick_start_title'),
                'description' => __('shadow::shadow.resources.quick_start_description'),
                'url' => $documentationUrl,
            ],
            [
                'icon' => 'forum',
                'title' => __('shadow::shadow.resources.community_title'),
                'description' => __('shadow::shadow.resources.community_description'),
                'url' => $documentationUrl,
            ],
        ];
    @endphp

    <div class="relative flex flex-1 flex-col overflow-x-hidden bg-background-light text-slate-900 dark:bg-background-dark dark:text-white">
        <div class="px-4 py-12 sm:px-8 md:px-16 lg:px-24 xl:px-40">
            <div class="mx-auto flex w-full max-w-[960px] flex-col gap-12 md:gap-16 lg:gap-20">
                <section class="mt-12 md:mt-16">
                    <div class="@container">
                        <div class="flex flex-col items-center gap-6 px-4 py-10 text-center @[480px]:gap-8">
                            <div class="flex max-w-2xl flex-col gap-6 @[480px]:gap-8">
                                <div class="flex flex-col gap-3 text-center">
                                    <h1 class="text-4xl font-black leading-tight tracking-[-0.03em] @[480px]:text-5xl dark:text-white">
                                        {{ __('shadow::shadow.hero_title') }}
                                    </h1>
                                    <p class="text-base leading-relaxed text-slate-600 @[480px]:text-lg dark:text-white/70">
                                        {{ __('shadow::shadow.hero_subtitle') }}
                                    </p>
                                </div>
                                <div class="flex flex-wrap justify-center gap-4">
                                    <a href="{{ route('products.index') }}"
                                       class="flex h-12 min-w-[120px] items-center justify-center rounded-full bg-primary px-6 text-base font-semibold text-white shadow-lg shadow-primary/40 transition-colors hover:bg-primary/80">
                                        {{ __('shadow::shadow.hero_primary_cta') }}
                                    </a>
                                    <a href="{{ $documentationUrl }}"
                                       class="flex h-12 min-w-[120px] items-center justify-center rounded-full border border-slate-200 bg-white px-6 text-base font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100 hover:text-slate-900 dark:border-white/10 dark:bg-white/5 dark:text-white/80 dark:hover:bg-white/10 dark:hover:text-white">
                                        {{ __('shadow::shadow.hero_secondary_cta') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="px-4 pb-4 text-center text-2xl font-semibold leading-tight tracking-[-0.015em] text-slate-900 dark:text-white">
                        {{ __('shadow::shadow.featured_apis_title') }}
                    </h2>
                    <div class="grid grid-cols-1 gap-6 p-4 md:grid-cols-2 lg:grid-cols-3">
                        @forelse($products as $product)
                            @include('components.product-card', ['product' => $product])
                        @empty
                            <div class="col-span-full">
                                @include('components.noitems')
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="px-4">
                    <label class="mx-auto flex w-full max-w-2xl flex-col">
                        <div class="flex h-12 w-full items-stretch rounded-2xl border border-slate-200 bg-white shadow-inner shadow-black/10 dark:border-border-dark/80 dark:bg-surface-muted dark:shadow-black/30">
                            <div class="flex items-center justify-center rounded-l-2xl border-r border-slate-200 bg-transparent pl-4 text-slate-400 dark:border-border-dark/50 dark:text-white/50">
                                <span class="material-symbols-outlined text-2xl">search</span>
                            </div>
                            <input type="search"
                                   class="form-input flex w-full flex-1 rounded-r-2xl border-0 bg-transparent px-4 text-base font-medium leading-normal text-slate-700 placeholder:text-slate-400 focus:outline-none dark:text-white dark:placeholder:text-white/40"
                                   placeholder="{{ __('shadow::shadow.search_placeholder') }}">
                        </div>
                    </label>
                </section>

                <section>
                    <div class="grid grid-cols-[repeat(auto-fit,minmax(220px,1fr))] gap-4 p-4">
                        @foreach($resourceCards as $resource)
                            <a href="{{ $resource['url'] }}"
                               class="flex flex-1 cursor-pointer flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition-all hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/10 dark:border-border-dark dark:bg-surface-dark">
                                <div class="text-primary">
                                    <span class="material-symbols-outlined text-2xl">{{ $resource['icon'] }}</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h3 class="text-base font-semibold leading-tight text-slate-900 dark:text-white">
                                        {{ $resource['title'] }}
                                    </h3>
                                    <p class="text-sm font-normal leading-normal text-slate-600 dark:text-white/60">
                                        {{ $resource['description'] }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section>
                    <h2 class="px-4 pb-4 text-center text-2xl font-semibold leading-tight tracking-[-0.015em] text-slate-900 dark:text-white">
                        {{ __('shadow::shadow.faq_title') }}
                    </h2>
                    <div class="flex flex-col gap-4 p-4">
                        @foreach($faqItems as $item)
                            <details class="group rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition dark:border-border-dark dark:bg-surface-dark">
                                <summary class="flex cursor-pointer items-center justify-between text-left text-base font-semibold text-slate-900 dark:text-white">
                                    <span>{{ $item['question'] }}</span>
                                    <span class="material-symbols-outlined text-xl text-slate-400 transition-transform duration-300 group-open:rotate-180 dark:text-white/60">expand_more</span>
                                </summary>
                                <p class="mt-3 text-sm text-slate-600 dark:text-white/70">{{ $item['answer'] }}</p>
                            </details>
                        @endforeach
                    </div>
                </section>

                <section class="my-12 rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-[0_20px_50px_-20px_rgba(15,23,42,0.2)] lg:p-14 dark:border-border-dark dark:bg-surface-dark dark:shadow-[0_20px_50px_-20px_rgba(0,0,0,0.6)]">
                    <h2 class="mb-4 text-2xl font-semibold text-slate-900 md:text-3xl dark:text-white">
                        {{ __('shadow::shadow.cta_title') }}
                    </h2>
                    <p class="mx-auto mb-6 max-w-2xl text-base text-slate-600 dark:text-white/70">
                        {{ __('shadow::shadow.cta_subtitle') }}
                    </p>
                    <a href="{{ route('products.index') }}"
                       class="mx-auto flex h-12 min-w-[160px] items-center justify-center rounded-full bg-primary px-6 text-base font-semibold text-white shadow-lg shadow-primary/40 transition-colors hover:bg-primary/80">
                        {{ __('shadow::shadow.cta_button') }}
                    </a>
                </section>
            </div>
        </div>
    </div>
@endsection

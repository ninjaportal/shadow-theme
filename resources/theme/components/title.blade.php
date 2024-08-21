<div class="">
    <div class="mx-auto max-w-7xl px-6 py-14 lg:flex lg:items-center lg:justify-between lg:px-8">
        <div class="flex-row">
            <nav class="hidden lg:flex mb-1" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    @if(isset($breadcrumbs))
                        @foreach($breadcrumbs as $breadcrumb)
                            @if ($loop->last)
                                <li>
                                    <div class="flex items center">
                                    <span aria-current="page"
                                          class="mr-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $breadcrumb['name'] }}
                                    </span>
                                    </div>
                                </li>
                                @continue
                            @endif
                            <li>
                                <div class="flex items-center">
                                    <a href="{{ $breadcrumb['url'] }}"
                                       class="mr-2 text-sm font-medium text-gray-900 dark:text-gray-100 hover:text-primary ease-in-out duration-150">
                                        {{ $breadcrumb['name'] }}
                                    </a>
                                    <x-heroicon-o-chevron-right class="h-5 w-5 text-gray-400 dark:text-gray-300"/>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ol>
            </nav>
            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl text-primary dark:text-white">
                {{ $title }}
            </h2>
        </div>
        {{ $slot }}
    </div>
</div>

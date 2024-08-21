@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="bg-white dark:bg-gray-800">
        <div class="relative isolate pt-0">
            <div class="mx-auto max-w-7xl px-6 py-4 sm:py-20 lg:flex-row-reverse lg:flex grid-cols-2 lg:items-center lg:gap-x-10 lg:px-8">
                <div class="mt-16 sm:mt-24 lg:mt-0">
                    <img class="w-full lg:h-auto lg:w-auto lg:max-w-full" alt="Hero image"
                         src="{{ asset('theme/img/hero1.png') }}" />
                </div>
                <div class="mx-auto max-w-2xl lg:mx-0 lg:flex-auto">
                    <h1 class="mt-10 max-w-lg text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-gray-100">
                        Digital Integration is now easier with  <span class="text-primary">Ninja</span>Portal
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600 line-height-[1.8] dark:text-gray-300">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <div class="mt-10 flex items-center gap-x-6">
                        <a href="#" class="btn btn-primary">Get started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-24 sm:py-32 dark:bg-gray-800">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-gray-100">
                    Stay on top of customer support
                </h2>
                <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Lorem ipsum dolor sit amet consect adipisicing elit. Possimus magnam voluptatum cupiditate veritatis in accusamus quisquam.
                </p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col dark:bg-gray-700 p-6">
                        <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">
                            <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-primary">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                                </svg>
                            </div>
                            Unlimited inboxes
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                            <p class="flex-auto">Non quo aperiam repellendus quas est est. Eos aut dolore aut ut sit nesciunt. Ex tempora quia. Sit nobis consequatur dolores incidunt.</p>
                            <p class="mt-6">
                                <a href="#" class="text-sm font-semibold leading-6 text-primary">
                                    Learn more <span aria-hidden="true">→</span>
                                </a>
                            </p>
                        </dd>
                    </div>
                    <div class="flex flex-col dark:bg-gray-700 p-6">
                        <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">
                            <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-primary">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                                </svg>
                            </div>
                            Unlimited inboxes
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                            <p class="flex-auto">Non quo aperiam repellendus quas est est. Eos aut dolore aut ut sit nesciunt. Ex tempora quia. Sit nobis consequatur dolores incidunt.</p>
                            <p class="mt-6">
                                <a href="#" class="text-sm font-semibold leading-6 text-primary">
                                    Learn more <span aria-hidden="true">→</span>
                                </a>
                            </p>
                        </dd>
                    </div>
                    <div class="flex flex-col dark:bg-gray-700 p-6">
                        <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">
                            <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-primary">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                                </svg>
                            </div>
                            Unlimited inboxes
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                            <p class="flex-auto">Non quo aperiam repellendus quas est est. Eos aut dolore aut ut sit nesciunt. Ex tempora quia. Sit nobis consequatur dolores incidunt.</p>
                            <p class="mt-6">
                                <a href="#" class="text-sm font-semibold leading-6 text-primary">
                                    Learn more <span aria-hidden="true">→</span>
                                </a>
                            </p>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-primary/20 dark:bg-primary/70">
        <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:flex lg:items-center lg:justify-between lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900  dark:text-gray-100 sm:text-4xl">Ready to dive in?<br>Start your free trial today.</h2>
            <div class="mt-10 flex items-center gap-x-6 lg:mt-0 lg:flex-shrink-0">
                <a href="#" class="btn btn-primary">Get started</a>
                <a href="#" class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100">Learn more <span aria-hidden="true">→</span></a>
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

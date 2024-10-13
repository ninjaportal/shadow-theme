@php
$breadcrumbs = [
    [
        'name' => __('shadow::shadow.home'),
        'url' => route('home')
    ],
    [
        'name' => __('shadow::shadow.register'),
        'url' => route('register')
    ],
];
@endphp
@extends("layouts.app")

@section("title", __("shadow::shadow.register"))

@section("content")

    @component('components.title', ["breadcrumbs"=>$breadcrumbs])
        @slot('title')
            {{ __("shadow::shadow.register") }}
        @endslot
    @endcomponent


    <div class="mx-auto max-w-7xl px-6 py-14">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
            <div class="form">
                {{ $form->render() }}
                <div class="links mt-4">
                    <a
                        class="text-sm text-gray-600 dark:text-gray-200 hover:text-primary dark:hover:text-primary transition duration-300"
                        href="{{ route("login") }}">
                        @lang("shadow::shadow.already_have_account")
                    </a>
                </div>
            </div>
            <div class="image">
                <img
                    class="mx-auto w-3/4 object-cover object-center"
                    src="{{ asset("theme/img/signup.png") }}" alt="">
            </div>
        </div>

    </div>
@endsection

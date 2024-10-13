@php
$breadcrumbs = [
    [
        'name' => __('shadow::shadow.home'),
        'url' => route('home')
    ],
    [
        'name' => __('shadow::shadow.login'),
        'url' => route('login')
    ],
];
@endphp
@extends("layouts.app")

@section("title", __("shadow::shadow.login"))

@section("content")
    @component('components.title', ["breadcrumbs"=>$breadcrumbs])
        @slot('title')
            {{ __("shadow::shadow.login") }}
        @endslot
    @endcomponent

    <div class="mx-auto max-w-7xl px-6 py-14">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
            <div class="form">

                {{ $form->render() }}
                <div class="links mt-4 sm:flex grid justify-between items-center">
                    <a
                        class="text-sm text-gray-600 dark:text-gray-200 hover:text-primary dark:hover:text-primary transition duration-300"
                        href="{{ route("register") }}">
                        @lang("shadow::shadow.dont_have_account")
                    </a>
                    <a class="text-sm text-gray-600 dark:text-gray-200 hover:text-primary dark:hover:text-primary transition duration-300"
                       href="{{ route("password.request") }}">
                        @lang("shadow::shadow.forget_password")
                    </a>
                </div>
            </div>
            <div class="image">
                <img
                    class="mx-auto w-3/4 object-cover object-center"
                    src="{{ asset("theme/img/login.png") }}" alt="">
            </div>
        </div>

    </div>
@endsection

@extends("layouts.app")

@section("title", __("shadow::shadow.reset_password"))

@section("content")
    @component('components.title', ["breadcrumbs"=>[
        [
            'name' => __('shadow::shadow.home'),
            'url' => route('home')
        ],
        [
            'name' => __('shadow::shadow.reset_password'),
            'url' => route('password.request')
        ],
    ]])
        @slot('title')
            {{ __("shadow::shadow.reset_password") }}
        @endslot
    @endcomponent

    <div class="mx-auto max-w-7xl px-6 py-14">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
            <div class="form">
                {{ $form->render() }}
            </div>
            <div class="image">
                <img
                    class="mx-auto w-3/4 object-cover object-center"
                    src="{{ asset("theme/img/password.png") }}" alt="">
            </div>
        </div>

    </div>
@endsection

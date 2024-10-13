@extends("layouts.app")

@section("title", __("shadow.new_app"))

@section("content")
    @component('components.title', ["breadcrumbs"=>[
        [
            'name' => __('shadow::shadow.home'),
            'url' => route('home')
        ],
        [
            'name' => __('shadow::shadow.apps'),
            'url' => route('apps.index')
        ],
        [
            'name' => __('shadow::shadow.new_app'),
            'url' => route('apps.create')
        ],
    ]])
        @slot('title')
            @lang("shadow::shadow.new_app")
        @endslot
    @endcomponent


    <div class="mx-auto max-w-7xl px-6 py-14">

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
        {{  $form->render() }}
        <div class="image">
            <img
                class="mx-auto w-3/4 object-cover object-center"
                src="{{ asset("theme/img/newapp.png") }}" alt="">
        </div>

    </div>
    </div>

@endsection

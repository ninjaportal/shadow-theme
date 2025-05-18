@extends("layouts.app")

@section("title", __("shadow.Profile"))

@section("content")
    @component('components.title', ["breadcrumbs"=>[
        [
            'name' => __('shadow::shadow.home'),
            'url' => route('home')
        ],
        [
            'name' => __('shadow::shadow.profile'),
            'url' => route('profile')
        ],
    ]])
        @slot('title')
            @lang("shadow::shadow.profile")
        @endslot
    @endcomponent

    <div class="mx-auto max-w-7xl px-6 py-14">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-8 gap-y-12">
            <div class="update-profile">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 dark:text-gray-200">@lang("shadow::shadow.update_profile")</h2>
                {{ $updateProfileForm->render() }}
            </div>
            <div class="update-password">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 dark:text-gray-200">@lang("shadow::shadow.update_password")</h2>
                {{ $updatePasswordForm->render() }}
            </div>
        </div>
    </div>
@endsection

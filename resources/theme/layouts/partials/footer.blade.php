<footer class="mt-auto border-t border-slate-200 bg-background-light py-10 dark:border-border-dark/70 dark:bg-background-dark">
    <div class="mx-auto flex max-w-7xl flex-col items-center gap-4 px-4 text-center text-sm text-slate-500 md:flex-row md:justify-between md:px-8 dark:text-white/50">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. @lang('shadow::shadow.all_rights_reserved')</p>
        <div class="flex items-center gap-4">
            <a href="#" class="transition hover:text-slate-800 dark:hover:text-white">@lang('shadow::shadow.terms_of_service')</a>
            <a href="#" class="transition hover:text-slate-800 dark:hover:text-white">@lang('shadow::shadow.privacy_policy')</a>
        </div>
    </div>
</footer>

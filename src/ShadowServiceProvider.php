<?php

namespace NinjaPortal\Shadow;

use Illuminate\Support\Facades\Validator;
use NinjaPortal\Shadow\Commands\ShadowInstallCommand;
use NinjaPortal\Shadow\Rules\CanAddProductsRule;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ShadowServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('shadow')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews()
            ->hasViewComponents("shadow")
            ->hasRoute('web')
            ->hasCommands([
                ShadowInstallCommand::class
            ])
            ->hasViews();
    }

    public function packageBooted()
    {
        Validator::extend('can_add_products', CanAddProductsRule::class);
        Validator::extend('recaptcha_v2', Rules\ReCaptchaV2Rule::class);
        // register middleware
        $this->app['router']->aliasMiddleware('set-locale', Middlewares\SetLocaleMiddleware::class);
    }

    public function packageRegistered()
    {
        // register singleton
        $this->publishes([
            __DIR__ . '/../assets/' => public_path(),
        ], 'shadow-assets');

        $this->publishes([
            __DIR__ . '/../resources/theme' => resource_path('views'),
        ], 'shadow-theme-views');

        $this->publishes([
            __DIR__ . '/../resources/js' => resource_path('js'),
        ], 'shadow-theme-js');

        $this->publishes([
            __DIR__ . '/../resources/css' => resource_path('css'),
        ], 'shadow-theme-style');

        $this->publishes([
            __DIR__ . '/../tailwind.config.js' => base_path('tailwind.config.js'),
        ], 'shadow-tailwind-config');
    }

}

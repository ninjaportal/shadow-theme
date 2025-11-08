<?php

namespace NinjaPortal\Shadow;

use Illuminate\Support\Facades\Route;
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
            ->hasConfigFile('shadow')
            ->hasViewComponents('shadow')
            ->hasTranslations()
            ->hasCommands([
                ShadowInstallCommand::class
            ]);
    }

    public function packageBooted(): void
    {
        // Register views from both locations with and without namespace
        // With namespace (shadow::)
        $this->loadViewsFrom(__DIR__.'/../resources/theme', 'shadow');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'shadow');
        
        // Without namespace (to override app views and allow relative paths)
        $this->app['view']->getFinder()->prependLocation(__DIR__.'/../resources/theme');
        
        // Register custom validators
        Validator::extend('can_add_products', CanAddProductsRule::class);
        Validator::extend('recaptcha_v2', Rules\ReCaptchaV2Rule::class);

        // Register middleware
        $this->app['router']->aliasMiddleware('set-locale', Middlewares\SetLocaleMiddleware::class);

        // Register routes with configuration
        $this->registerRoutes();

        // Register publishable resources
        $this->registerPublishables();
    }

    /**
     * Register routes with configuration options
     * Routes are loaded in booted() to ensure config is available
     */
    protected function registerRoutes(): void
    {
        if (config('shadow.routes.enabled', true)) {
            Route::group([
                'prefix' => config('shadow.routes.prefix', ''),
                'middleware' => config('shadow.routes.middleware', ['web', 'set-locale']),
                'domain' => config('shadow.routes.domain'),
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            });
        }
    }

    /**
     * Register publishable resources
     */
    protected function registerPublishables(): void
    {
        // Essential assets (always needed for production)
        $this->publishes([
            __DIR__ . '/../public/' => public_path('vendor/shadow/'),
            __DIR__ . '/../assets/theme/' => public_path('theme/'),
        ], 'shadow-assets');

        // Views (optional customization) - publish to vendor directory for partial override
        $this->publishes([
            __DIR__ . '/../resources/theme' => resource_path('views/vendor/shadow'),
        ], 'shadow-views');

        // Frontend build assets (for customization)
        $this->publishes([
            __DIR__ . '/../resources/js' => resource_path('js/vendor/shadow'),
            __DIR__ . '/../resources/css' => resource_path('css/vendor/shadow'),
        ], 'shadow-frontend');

        // Translations (for adding/modifying languages)
        $this->publishes([
            __DIR__.'/../resources/lang' => lang_path('vendor/shadow'),
        ], 'shadow-lang');

        // Tailwind config (for complete theme customization)
        $this->publishes([
            __DIR__ . '/../tailwind.config.js' => base_path('tailwind.shadow.config.js'),
        ], 'shadow-tailwind');

        // Complete package (for quick setup - minimal required files)
        $this->publishes([
            __DIR__ . '/../public/' => public_path('vendor/shadow/'),
        ], 'shadow');
    }
}

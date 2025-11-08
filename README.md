# Shadow Theme for Laravel

A beautiful, modern Laravel theme package for API Developer Portals with built-in authentication, product management, and multi-language support.

## Features

✨ **Auto-Registration** - Works out of the box after installation  
🎨 **Customizable** - Publish only what you need to customize  
🌍 **Multi-language** - Built-in English and Arabic translations  
🔐 **Authentication** - Complete auth system with login, register, and password reset  
📦 **API Products** - Product catalog with Swagger documentation viewer  
👤 **User Dashboard** - App management and API key generation  
🌙 **Dark Mode** - Optional dark mode support  
🎯 **Laravel Conventions** - Follows standard Laravel package patterns  

## Installation

### Quick Install (Recommended)

```bash
composer require ninjaportal/shadow-theme
php artisan shadow:install
npm install && npm run build
```

That's it! The theme is now active and working.

### Custom Install

If you want to customize specific parts:

```bash
# Install with specific components
php artisan shadow:install --views --config

# Or install everything
php artisan shadow:install --all

# Available options:
# --views      Publish views for customization
# --config     Publish configuration file
# --frontend   Publish JS/CSS files
# --lang       Publish language files
# --tailwind   Publish Tailwind configuration
# --all        Publish everything
# --force      Overwrite existing files
```

## How It Works

### Auto-Registration

The package uses Laravel's auto-discovery feature. Once installed via Composer:

1. **Service Provider** is automatically registered
2. **Routes** are automatically loaded (customizable via config)
3. **Views** are loaded from package (overridable)
4. **Translations** are loaded from package (extendable)
5. **Assets** are served from `public/vendor/shadow/`

### View Loading Hierarchy

Laravel loads views in this order:

1. `resources/views/vendor/shadow/` (if you published views)
2. Package views (fallback)

This means you can override any view by publishing and modifying it!

## Configuration

### Environment Variables

Add these to your `.env` file:

```env
# Shadow Theme Configuration
SHADOW_DEFAULT_THEME=default  # or 'dark'
SHADOW_DARKMODE_ENABLED=false

# ReCaptcha (optional)
RECAPTCHA_ENABLED=false
RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET=

# App Keys Configuration
KEYS_PER_APP=2

# Routes (optional)
SHADOW_ROUTES_ENABLED=true
SHADOW_ROUTES_PREFIX=
SHADOW_ROUTES_DOMAIN=
```

### Config File

Publish the config file for more control:

```bash
php artisan vendor:publish --tag=shadow-config
```

Then edit `config/shadow.php`:

```php
return [
    'default_theme' => 'default',
    'darkmode_enabled' => false,
    'locales' => [
        'en' => 'English',
        'ar' => 'العربية',
    ],
    'routes' => [
        'enabled' => true,
        'prefix' => '',
        'middleware' => ['web', 'set-locale'],
        'domain' => null,
    ],
];
```

## Customization

### Customizing Views

Publish views to modify them:

```bash
php artisan vendor:publish --tag=shadow-views
```

Views will be published to `resources/views/vendor/shadow/`. Modify any view and it will override the package version.

### Customizing Translations

```bash
php artisan vendor:publish --tag=shadow-lang
```

Translations will be published to `lang/vendor/shadow/`. Add new languages or modify existing ones.

### Customizing Frontend

```bash
php artisan vendor:publish --tag=shadow-frontend
```

This publishes JS and CSS files to `resources/js/vendor/shadow/` and `resources/css/vendor/shadow/`.

### Customizing Tailwind

```bash
php artisan vendor:publish --tag=shadow-tailwind
```

This publishes `tailwind.shadow.config.js` for complete theme customization.

## Routes

The package registers the following routes:

### Public Routes
- `GET /` - Home page
- `GET /products` - Product listing
- `GET /products/{id}` - Product details
- `GET /auth/login` - Login page
- `POST /auth/login` - Login action
- `GET /auth/register` - Register page
- `POST /auth/register` - Register action
- `GET /auth/forgot-password` - Password reset request
- `POST /auth/forgot-password` - Send reset link
- `GET /auth/reset-password/{token}` - Password reset form
- `POST /auth/reset-password` - Reset password action

### Protected Routes (auth required)
- `GET /apps` - User apps listing
- `GET /apps/create` - Create app form
- `POST /apps/create` - Store app
- `GET /apps/{id}` - App details
- `GET /apps/{id}/edit` - Edit app form
- `PUT /apps/{id}/edit` - Update app
- `DELETE /apps/{id}` - Delete app
- `POST /apps/{id}/keys/create` - Create API key
- `DELETE /apps/{id}/keys/{key}/delete` - Delete API key
- `GET /profile` - User profile
- `POST /profile` - Update profile
- `POST /profile/password` - Update password
- `POST /logout` - Logout

### Utility Routes
- `GET /lang/{lang}` - Change language

### Disabling Routes

To disable automatic route registration:

```php
// config/shadow.php
'routes' => [
    'enabled' => false,
],
```

Then manually register routes in your `routes/web.php`:

```php
Route::middleware(['web', 'set-locale'])->group(function () {
    Route::prefix('portal')->group(function () {
        require base_path('vendor/ninjaportal/shadow-theme/routes/web.php');
    });
});
```

## Translation Usage

In Blade views:

```blade
@lang('shadow::shadow.home')
{{ __('shadow::shadow.products') }}
```

Available translations:
- English (en)
- Arabic (ar)

## Components

### Blade Components

```blade
{{-- Swagger API Viewer --}}
<x-shadow::swagger-viewer :swagger-file="$url" />

{{-- Product Card --}}
@component('components.product-card', ['product' => $product])
@endcomponent

{{-- Title with Breadcrumbs --}}
@component('components.title', ['breadcrumbs' => $breadcrumbs])
    @slot('title')
        Page Title
    @endslot
@endcomponent

{{-- No Items Message --}}
@include('components.noitems')
```

## Middleware

### SetLocaleMiddleware

Automatically registered as `set-locale`. Sets the application locale based on:
1. Cookie value
2. Browser preference
3. Default locale

Usage:

```php
Route::middleware('set-locale')->group(function () {
    // Your routes
});
```

## Directory Structure

```
packages/shadow-theme/
├── config/
│   └── shadow.php              # Configuration file
├── public/
│   ├── build/                  # Built assets
│   └── swagger/                # Swagger UI assets
├── resources/
│   ├── css/
│   │   └── app.scss           # Main stylesheet
│   ├── js/
│   │   └── app.js             # Main JavaScript
│   ├── lang/
│   │   ├── en/
│   │   │   └── shadow.php     # English translations
│   │   └── ar/
│   │       └── shadow.php     # Arabic translations
│   ├── theme/                  # Blade views
│   │   ├── auth/
│   │   ├── layouts/
│   │   ├── products/
│   │   ├── user/
│   │   └── components/
│   └── views/
│       └── components/         # Package components
├── routes/
│   └── web.php                 # Package routes
├── src/
│   ├── Commands/
│   │   └── ShadowInstallCommand.php
│   ├── Controllers/
│   ├── Middlewares/
│   ├── Rules/
│   └── ShadowServiceProvider.php
└── composer.json
```

## Requirements

- PHP ^8.2
- Laravel ^11.0 || ^12.0
- ninjaportal/portal ^0.1

## Publishing Tags

| Tag | Description | Path |
|-----|-------------|------|
| `shadow` | Minimal required assets | `public/vendor/shadow/` |
| `shadow-assets` | Public assets | `public/vendor/shadow/` |
| `shadow-views` | Blade views | `resources/views/vendor/shadow/` |
| `shadow-config` | Configuration | `config/shadow.php` |
| `shadow-frontend` | JS/CSS source files | `resources/js|css/vendor/shadow/` |
| `shadow-lang` | Translation files | `lang/vendor/shadow/` |
| `shadow-tailwind` | Tailwind config | `tailwind.shadow.config.js` |

## Support

For issues, questions, or contributions, please visit:
- GitHub: [ninjaportal/shadow-theme](https://github.com/ninjaportal/ninjaportal)

## License

The Shadow Theme is open-sourced software licensed under the [MIT license](LICENSE.md).

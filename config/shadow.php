<?php

return [

    /**
     * Default theme : default, dark
     */
    "default_theme" => env("SHADOW_DEFAULT_THEME", "default"),

    /**
     * enable dark mode amd dark mode switcher
     */
    "darkmode_enabled" => env("SHADOW_DARKMODE_ENABLED", false),

    /**
     * ReCaptcha settings, will be used in sign up and login forms
     */
    "recaptcha" => [
        "enabled" => env("RECAPTCHA_ENABLED", false),
        "site_key" => env("RECAPTCHA_SITE_KEY", ""),
        "secret_key" => env("RECAPTCHA_SECRET", ""),
    ],

    /**
     * The number of keys that can be generated per app
     */
    "keys_per_app" => env("KEYS_PER_APP", 2),

    /**
     * Locales ex: ['en' => 'English', 'ar' => 'العربية']
     */
    "locales" => [],

    /**
     * Routes configuration
     */
    "routes" => [
        "enabled" => env("SHADOW_ROUTES_ENABLED", true),
        "prefix" => env("SHADOW_ROUTES_PREFIX", ""),
        "middleware" => ["web", "set-locale"],
        "domain" => env("SHADOW_ROUTES_DOMAIN", null),
    ],
];

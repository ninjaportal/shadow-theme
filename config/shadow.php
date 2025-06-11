<?php

return [
    /**
     * Default theme mode.
     * * Available options:
     * * - default: Default theme mode, uses the default theme.
     * * - dark: Dark theme mode, uses the dark theme.
     * */
    "default_theme" => "default",

    // Dark mode functionality
    "darkmode_enabled" => env("SHADOW_DARKMODE_ENABLED", true),

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

];

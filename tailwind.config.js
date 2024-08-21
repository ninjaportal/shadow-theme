/** @type {import('tailwindcss').Config} */
export default {
    daisyui: {
        darkTheme: "dark",
        themes: [
            {
                dark: {
                    ...require("daisyui/src/theming/themes.js").dark,
                    "primary": "#d43a01",
                }
            },
            {
                default: {
                    "primary": "#d43a01",
                    "primary-focus": "#fc4c02",
                    "secondary": "#fc4c02",
                    "accent": "#37cdbe",
                    "neutral": "#151d28",
                    "base-100": "#f7f7f8",
                    "info": "#95d5e4",
                    "warning": "#f0a53d",
                    "error": "#d92644",
                    'success': '#2dca73',
                }
            }
        ]
    },
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/ninjaportal/shadow/resources/**/*.blade.php",
    ],
    safelist: [
        {
            pattern: /grid-cols-\d+/,
        },
        {
            pattern: /col-span-\d+/
        }
    ],
    darkMode:  ['class', '[data-theme="dark"]'],
    plugins: [
        require("daisyui"),
    ]
}


/** @type {import('tailwindcss').Config} */
export default {
    daisyui: {
        darkTheme: "dark",
        themes: [
            {
                dark: {
                    ...require("daisyui/src/theming/themes.js").dark,
                    "primary": "#d43a01",
                    "primary-focus": "#a32d01",
                }
            },
            {
                default: {
                    "primary": "#d43a01",
                    "primary-focus": "#a32d01",
                    "secondary": "#d43a01",
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
        },
        'lg:col-span-1',
        'lg:col-span-2',
        'lg:grid-cols-2',
        'lg:gap-6'
    ],
    darkMode:  ['class', '[data-theme="dark"]'],
    theme: {
        extend: {
            colors: {
                primary: '#d43a01',
                'primary-foreground': '#fff5f0',
                'background-light': '#f5f6f8',
                'background-dark': '#0f1729',
                'surface-dark': '#111c2e',
                'surface-muted': '#1b2641',
                'border-dark': '#1e2a44',
            },
            fontFamily: {
                display: ['"Space Grotesk"', 'sans-serif'],
            },
            borderRadius: {
                DEFAULT: '0.25rem',
                lg: '0.5rem',
                xl: '0.75rem',
                full: '9999px',
            },
        }
    },
    plugins: [
        require("daisyui"),
        require('@tailwindcss/forms'),
        require('@tailwindcss/container-queries'),
    ]
}


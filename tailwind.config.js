import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require("daisyui")],
    daisyui: {
        themes: [
            {
                tempo: {
                    primary: "#D78726",
                    secondary: "#F0F8FF",
                    accent: "#DC7E27",
                    neutral: "#000000",
                    hover: "rgba(102, 178, 255, 0.1)",
                    "base-100": "#FFFFFF",
                    info: "#0047ff",
                    success: "#00c259",
                    warning: "#e93500",
                    error: "#ff5059",
                },
            },
        ],
    },
};

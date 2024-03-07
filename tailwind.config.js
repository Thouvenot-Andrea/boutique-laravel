/** @type {import('tailwindcss').Config} */

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("daisyui")],
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
}


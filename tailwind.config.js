const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    purge: {
        content: [
            "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
            "./vendor/laravel/jetstream/**/*.blade.php",
            "./storage/framework/views/*.php",
            "./resources/views/**/*.blade.php",
        ],
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: (theme) => ({
                "food-pattern": "url('/img/food-pattern.png')",
                "default-parttern": "url('')",
            }),
            backgroundSize: {
                auto: "auto",
                cover: "cover",
                contain: "contain",
                three: "300px",
                four: "400px",
            },
        },
    },

    variants: {
        extend: {
            opacity: ["disabled"],
        },
    },
    daisyui: {
        themes: [
            {
            'mytheme': {
                'primary': '#fb2323',
                'primary-focus': '#ba0000',
                'primary-content': '#ffffff',
                'secondary': '#f000b8',
                'secondary-focus': '#bd0091',
                'secondary-content': '#ffffff',
                'accent': '#37cdbe',
                'accent-focus': '#2aa79b',
                'accent-content': '#ffffff',
                'neutral': '#3d4451',
                'neutral-focus': '#2a2e37',
                'neutral-content': '#ffffff',
                'base-100': '#ffffff',
                'base-200': '#f9fafb',
                'base-300': '#d1d5db',
                'base-content': '#1f2937',
                'info': '#2094f3',
                'success': '#009485',
                'warning': '#ff9900',
                'error': '#ff5724',
            },
            },
        ],
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("daisyui"),
    ],
};

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
                "food-pattern": "url('/img/food-pattern.jpg')",
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
        themes: true,
        themes: [
            {
            'dsc': {
                'primary': '#EA5234',
                'primary-focus': '#D43616',
                'primary-content': '#FFFFFF',
                'secondary': '#E96D7C',
                'secondary-focus': '#E24053',
                'secondary-content': '#FFFFFF',
                'accent': '#EEAF3A',
                'accent-focus': '#E19914',
                'accent-content': '#FFFFFF',
                'neutral': '#1B0D22',
                'neutral-focus': '#D6D6D6',
                'neutral-content': '#FFFFFF',
                'base-100': '#FAF7F5',
                'base-200': '#EFEAE6',
                'base-300': '#E7E2DF',
                'base-content': '#291334',
                'info': '#3C8DAD',
                'success': '#01937C',
                'warning': '#E1701A',
                'error': '#FF5724',
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

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

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("daisyui"),
    ],
};

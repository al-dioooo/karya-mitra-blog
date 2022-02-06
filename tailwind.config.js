const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
    mode: "jit",
    purge: {
        content: [
            "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
            "./vendor/laravel/jetstream/**/*.blade.php",
            "./storage/framework/views/*.php",
            "./resources/views/**/*.blade.php",
        ],
        safelist: [
            "aspect-w-21",
            "aspect-w-16",
            "aspect-w-1",
            "aspect-h-9",
            "aspect-h-1",
        ],
    },

    theme: {
        extend: {
            aspectRatio: {
                21: "21",
            },
            colors: {
                gray: colors.blueGray,
                teal: colors.teal,
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
        require("@tailwindcss/aspect-ratio"),
    ],
};

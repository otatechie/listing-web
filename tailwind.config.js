/** @type {import('tailwindcss').Config} */
import forms from '@tailwindcss/forms'

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./pages/**/*.{html,js}",
        "./components/**/*.{html,js}",
    ],
    theme: {
        extend: {},
        fontFamily: {
            heading: ["Alexandria", "sans-serif"],
            sans: ["Anuphan", "sans-serif"],
        },
    },
    plugins: [forms],
};

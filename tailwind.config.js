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
            sans: ["Plus Jakarta Sans", "sans-serif"],
            heading: ["Libre Baskerville", "serif"],
        },
    },
    plugins: [forms],
};

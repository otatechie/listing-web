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
            sans: ["Gantari", "sans-serif"],
            heading: ["Gantari", "sans-serif"],
        },
    },
    plugins: [forms],
};

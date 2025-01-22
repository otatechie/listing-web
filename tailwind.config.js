/** @type {import('tailwindcss').Config} */
import forms from "@tailwindcss/forms";

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./pages/**/*.{html,js}",
        "./components/**/*.{html,js}",
    ],
    theme: {
        extend: {
            fontWeight: {
                normal: "400",
                medium: "500",
                semibold: "700",
                bold: "800",
            },
        },
        fontFamily: {
            heading: ["Plus Jakarta Sans", "sans-serif"],
            sans: ["Plus Jakarta Sans", "sans-serif"],
        },
    },
    plugins: [forms],
};

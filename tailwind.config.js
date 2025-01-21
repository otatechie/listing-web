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
       extend: {
           fontWeight: {
               normal: '400',
               medium: '600',
               semibold: '700',
               bold: '800'
           }
       },
       fontFamily: {
           heading: ["Manrope", "sans-serif"],
           sans: ["Manrope", "sans-serif"],
       },
   },
   plugins: [forms],
};

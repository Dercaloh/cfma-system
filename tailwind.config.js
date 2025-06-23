import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        'sena-verde': '#39A900',
        'sena-verde-sec': '#007832',
        'sena-azul': '#00304D',
        'sena-gris': '#F6F6F6',
        'sena-blanco': '#FFFFFF',
      },
    },
  },

  plugins: [forms],
};

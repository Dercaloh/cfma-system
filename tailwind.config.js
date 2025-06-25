// tailwind.config.js
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['system-ui', 'Figtree', ...defaultTheme.fontFamily.sans],
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

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
        sans: ['"Work Sans"', 'system-ui', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        'sena-verde': '#39A900',
        'sena-verde-sec': '#007832',
        'sena-azul': '#00304D',
        'sena-gris': '#F6F6F6',
        'sena-blanco': '#FFFFFF',
        'sena-amarillo': '#FDC300',
        'sena-azul-violeta': '#71277A',
        'sena-cian': '#50E5F9',
      },
    },
  },
  plugins: [forms],
};

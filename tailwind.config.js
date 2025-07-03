// tailwind.config.js
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  safelist: [
    'privacy-policy',
    'header',
    'legal-notice',
    'consent-summary',
    'footer',
    'text-sena-verde',
    'text-sena-azul',
    'text-sena-verde-sec',
    'bg-sena-blanco',
    'bg-white/70',
    'bg-white/80',
    'border-sena-verde',
    'border-sena-verde/30',
    'border-sena-verde/20',
    'shadow-inner',
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

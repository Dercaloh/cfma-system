// tailwind.config.js
import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import plugin from "tailwindcss/plugin";

export default {
    content: ["./resources/views/**/*.blade.php", "./resources/js/**/*.js"],
    safelist: [
        // Utilidades clave
        "focus-visible",
        "focus:outline-none",
        "focus:ring-2",
        "focus:ring-sena-azul",
        "text-sena-verde",
        "text-sena-azul",
        "text-sena-verde-sec",
        "bg-sena-blanco",
        "bg-white/70",
        "bg-white/80",
        "border-sena-verde",
        "border-sena-verde/30",
        "border-sena-verde/20",
        "shadow-inner",
    ],
    theme: {
        screens: {
            xs: "360px",
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1280px",
            "2xl": "1366px",
            "3xl": "1920px",
        },
        extend: {
            fontFamily: {
                sans: ['"Work Sans"', ...defaultTheme.fontFamily.sans],
                secondary: ['"Calibri"', "sans-serif"],
            },
            colors: {
                "sena-verde": {
                    DEFAULT: "#39A900",
                    700: "#2D8700",
                },
                "sena-verde-sec": "#007832",
                "sena-azul": {
                    DEFAULT: "#00304D",
                    300: "#4D6D8C",
                },
                "sena-gris": "#F6F6F6",
                "sena-blanco": "#FFFFFF",
                "sena-amarillo": "#FDC300",
                "sena-azul-violeta": "#71277A",
                "sena-cian": "#50E5F9",
            },
            backdropBlur: {
                xs: "2px",
            },
            boxShadow: {
                glass: "inset 0 0 12px rgba(255, 255, 255, 0.5)",
                neumorph:
                    "8px 8px 16px rgba(0, 0, 0, 0.1), -8px -8px 16px rgba(255, 255, 255, 0.6)",
            },
            spacing: {
                touch: "48px",
            },
        },
    },
    plugins: [
        forms,
        plugin(({ addComponents }) => {
            addComponents({
                // 🎯 Botón Institucional Accesible
                ".btn-sena": {
                    "@apply px-6 py-3 rounded-lg font-semibold text-white bg-sena-verde transition min-h-touch":
                        "",
                    "&:hover": {
                        "@apply bg-sena-verde-sec": "",
                    },
                    "&:focus": {
                        "@apply ring-2 ring-offset-2 ring-sena-azul-300 focus:outline-none":
                            "",
                    },
                },

                // 🎯 Tarjeta con efecto glassmorphism institucional
                ".card-glass": {
                    "@apply p-6 rounded-xl border border-sena-verde/20 shadow-glass bg-white/70 backdrop-blur-xs":
                        "",
                    "backdrop-filter": "blur(8px)",
                },

                // 📄 Sección Legal Accesible
                ".section-legal": {
                    "@apply w-full max-w-screen-xl mx-auto px-6 py-8 font-sans text-gray-800 bg-sena-blanco":
                        "",
                },
                ".section-legal p": {
                    "@apply mb-4 leading-relaxed text-justify": "",
                },
                ".section-legal ul": {
                    "@apply pl-4 mb-4 list-disc list-inside": "",
                },
                ".section-legal table": {
                    "@apply w-full mb-6 text-sm text-left border border-gray-300":
                        "",
                },
                ".section-legal th": {
                    "@apply px-4 py-2 text-white bg-sena-verde": "",
                },
                ".section-legal td": {
                    "@apply px-4 py-2 text-gray-900 border-t border-gray-300 bg-white/80":
                        "",
                },
                ".section-legal h2": {
                    "@apply mt-6 mb-2 text-xl font-bold text-sena-verde": "",
                },
                ".section-legal h3": {
                    "@apply mt-4 mb-2 text-lg font-semibold text-sena-azul": "",
                },
                ".section-legal .header": {
                    "@apply text-center pb-6 mb-8 border-b-4 border-sena-verde":
                        "",
                },
                ".section-legal .header h1": {
                    "@apply mb-2 text-2xl font-bold text-sena-azul": "",
                },
                ".section-legal .header h2": {
                    "@apply mb-2 text-xl font-semibold text-sena-verde-sec": "",
                },

                // 🔐 Aviso legal o consentimiento
                ".legal-notice": {
                    "@apply p-4 mb-4 border rounded-md shadow-sm bg-white/70 border-sena-verde/20":
                        "",
                },

                ".consent-summary": {
                    "@apply p-6 mt-8 border rounded-xl shadow-inner bg-white/80 border-sena-verde/30":
                        "",
                },

                ".footer": {
                    "@apply mt-6 text-xs text-center text-gray-600": "",
                },

                '&[aria-pressed="true"]': {
                    "@apply bg-sena-verde-sec ring-2 ring-sena-amarillo": "",
                },

                // 🧩 Campos de formulario accesibles
                ".form-input": {
                    "@apply block w-full rounded-md border-gray-300 shadow-sm text-sm text-gray-900 focus:border-sena-verde focus:ring-sena-azul disabled:opacity-70 disabled:cursor-not-allowed":
                        "",
                },

                ".form-checkbox": {
                    "@apply h-5 w-5 text-sena-verde border-gray-300 rounded focus:ring focus:ring-sena-azul focus:ring-opacity-50 focus:outline-none":
                        "",
                },

                ".form-label": {
                    "@apply block text-sm font-medium text-gray-700 cursor-pointer":
                        "",
                },

                ".form-description": {
                    "@apply text-xs text-gray-500 mt-1": "",
                },

                ".form-error": {
                    "@apply mt-1 text-sm text-red-600": "",
                },
            });
        }),
    ],
};

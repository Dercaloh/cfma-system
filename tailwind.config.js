// tailwind.config.js
import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import plugin from "tailwindcss/plugin";

export default {
    content: ["./resources/views/**/*.blade.php", "./resources/js/**/*.js"],
    safelist: [
        // Utilidades clave existentes
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
        // Nuevas utilidades para componentes
        "shadow-neumorph",
        "shadow-neumorph-inset",
        "shadow-glass",
        "backdrop-blur-xs",
        "bg-gradient-to-br",
        "from-sena-verde",
        "to-sena-verde-sec",
        "hover:shadow-neumorph-hover",
        "transform",
        "hover:translateX-1",
        "hover:translateY-1",
        "transition-all",
        "duration-200",
        "ease-in-out",
        "ring-sena-verde/20",
        "ring-sena-azul/20",
        "border-sena-gris/30",
        "text-sena-azul/70",
        "bg-sena-gris/50",
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
                secondary: ['"Calibri"', "Arial", "sans-serif"], // ← aquí agregas Arial como fallback universal
            },

            colors: {
                "sena-verde": {
                    DEFAULT: "#39A900",
                    50: "#F0F9E8",
                    100: "#E1F3D1",
                    200: "#C3E7A3",
                    300: "#A5DB75",
                    400: "#87CF47",
                    500: "#39A900",
                    600: "#2D8700",
                    700: "#216500",
                    800: "#154300",
                    900: "#0A2100",
                },
                "sena-verde-sec": "#007832",
                "sena-azul": {
                    DEFAULT: "#00304D",
                    50: "#E6F2FF",
                    100: "#CCE5FF",
                    200: "#99CBFF",
                    300: "#4D6D8C",
                    400: "#265C7A",
                    500: "#00304D",
                    600: "#00263D",
                    700: "#001C2E",
                    800: "#00131F",
                    900: "#000A0F",
                },
                "sena-gris": {
                    DEFAULT: "#F6F6F6",
                    50: "#FAFAFA",
                    100: "#F6F6F6",
                    200: "#E5E5E5",
                    300: "#D4D4D4",
                    400: "#A3A3A3",
                    500: "#737373",
                    600: "#525252",
                    700: "#404040",
                    800: "#262626",
                    900: "#171717",
                },
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
                "neumorph-inset":
                    "inset 8px 8px 16px rgba(0, 0, 0, 0.1), inset -8px -8px 16px rgba(255, 255, 255, 0.6)",
                "neumorph-hover":
                    "4px 4px 8px rgba(0, 0, 0, 0.15), -4px -4px 8px rgba(255, 255, 255, 0.7)",
                "neumorph-light":
                    "4px 4px 8px rgba(0, 0, 0, 0.05), -4px -4px 8px rgba(255, 255, 255, 0.8)",
                "sena-subtle": "0 2px 4px rgba(57, 169, 0, 0.1)",
                "sena-medium": "0 4px 8px rgba(57, 169, 0, 0.15)",
                "sena-strong": "0 8px 16px rgba(57, 169, 0, 0.2)",
            },
            spacing: {
                touch: "48px",
            },
            animation: {
                "fade-in": "fadeIn 0.3s ease-in-out",
                "slide-in": "slideIn 0.3s ease-in-out",
                "pulse-soft": "pulseSoft 2s ease-in-out infinite",
            },
            keyframes: {
                fadeIn: {
                    "0%": { opacity: "0", transform: "translateY(10px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                slideIn: {
                    "0%": { transform: "translateX(-10px)", opacity: "0" },
                    "100%": { transform: "translateX(0)", opacity: "1" },
                },
                pulseSoft: {
                    "0%, 100%": { opacity: "1" },
                    "50%": { opacity: "0.8" },
                },
            },
        },
    },
    plugins: [
        forms,
        plugin(({ addComponents }) => {
            addComponents({
                // 🎯 Componentes existentes
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

                ".card-glass": {
                    "@apply p-6 rounded-xl border border-sena-verde/20 shadow-glass bg-white/70 backdrop-blur-xs":
                        "",
                    "backdrop-filter": "blur(8px)",
                },

                // 📊 Componentes de Estadísticas
                ".stats-card": {
                    "@apply p-6 rounded-xl border border-sena-gris/30 shadow-neumorph bg-white/90 backdrop-blur-xs transition-all duration-200 hover:shadow-neumorph-hover":
                        "",
                    "backdrop-filter": "blur(10px)",
                },

                ".stats-card-icon": {
                    "@apply flex items-center justify-center w-12 h-12 rounded-full shadow-neumorph-light":
                        "",
                },

                ".stats-grid": {
                    "@apply grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4":
                        "",
                },

                ".stats-value": {
                    "@apply text-3xl font-bold font-sans": "",
                },

                ".stats-label": {
                    "@apply text-sm font-medium text-sena-azul/70 font-secondary":
                        "",
                },

                // 🔍 Componentes de Filtros
                ".filter-form": {
                    "@apply p-6 mb-8 rounded-xl border border-sena-gris/30 shadow-neumorph bg-white/90 backdrop-blur-xs":
                        "",
                    "backdrop-filter": "blur(10px)",
                },

                ".filter-input": {
                    "@apply block w-full rounded-lg border-sena-gris/50 shadow-neumorph-inset bg-white/80 text-sm text-sena-azul placeholder-sena-azul/50 focus:border-sena-verde focus:ring-sena-verde/20 focus:shadow-sena-subtle transition-all duration-200":
                        "",
                },

                ".filter-select": {
                    "@apply block w-full rounded-lg border-sena-gris/50 shadow-neumorph-inset bg-white/80 text-sm text-sena-azul focus:border-sena-verde focus:ring-sena-verde/20 focus:shadow-sena-subtle transition-all duration-200":
                        "",
                },

                ".filter-active": {
                    "@apply ring-2 ring-sena-verde/30 border-sena-verde/50 bg-sena-verde/5":
                        "",
                },

                ".filter-button": {
                    "@apply inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-white shadow-neumorph bg-gradient-to-r from-sena-verde to-sena-verde-sec hover:shadow-neumorph-hover focus:outline-none focus:ring-2 focus:ring-sena-verde/20 focus:ring-offset-2 transition-all duration-200":
                        "",
                },

                ".filter-reset": {
                    "@apply inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-sena-azul bg-sena-gris/50 border border-sena-gris/30 shadow-neumorph hover:shadow-neumorph-hover hover:bg-sena-gris/70 focus:outline-none focus:ring-2 focus:ring-sena-azul/20 focus:ring-offset-2 transition-all duration-200":
                        "",
                },

                // 📋 Componentes de Tabla
                ".table-container": {
                    "@apply overflow-hidden rounded-xl border border-sena-gris/30 shadow-neumorph bg-white/90 backdrop-blur-xs":
                        "",
                    "backdrop-filter": "blur(10px)",
                },

                ".table-header": {
                    "@apply bg-gradient-to-r from-sena-gris/80 to-sena-gris/60 backdrop-blur-xs":
                        "",
                },

                ".table-header-cell": {
                    "@apply px-6 py-4 text-xs font-medium tracking-wider text-left uppercase text-sena-azul font-secondary":
                        "",
                },

                ".table-sortable": {
                    "@apply flex items-center gap-1 cursor-pointer hover:text-sena-verde transition-colors duration-200":
                        "",
                },

                ".table-row": {
                    "@apply transition-all duration-200 hover:bg-sena-gris/30 hover:shadow-neumorph-light":
                        "",
                },

                ".table-cell": {
                    "@apply px-6 py-4 text-sm text-sena-azul": "",
                },

                ".table-cell-icon": {
                    "@apply flex items-center justify-center w-10 h-10 rounded-lg shadow-neumorph-light bg-gradient-to-br from-sena-verde to-sena-verde-sec":
                        "",
                },

                // 🏷️ Componentes de Estado
                ".status-badge": {
                    "@apply inline-flex items-center px-3 py-1 rounded-full text-xs font-medium font-secondary shadow-neumorph-light":
                        "",
                },

                ".status-active": {
                    "@apply bg-sena-verde-100 text-sena-verde-700 border border-sena-verde-200":
                        "",
                },

                ".status-inactive": {
                    "@apply bg-red-100 text-red-700 border border-red-200": "",
                },

                // 🎬 Componentes de Acciones
                ".action-button": {
                    "@apply inline-flex items-center justify-center p-2 rounded-lg shadow-neumorph-light hover:shadow-neumorph-hover focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200":
                        "",
                },

                ".action-view": {
                    "@apply text-sena-azul hover:text-sena-azul-600 focus:ring-sena-azul/20":
                        "",
                },

                ".action-edit": {
                    "@apply text-sena-amarillo hover:text-yellow-600 focus:ring-sena-amarillo/20":
                        "",
                },

                ".action-delete": {
                    "@apply text-red-500 hover:text-red-600 focus:ring-red-500/20":
                        "",
                },

                ".action-group": {
                    "@apply flex items-center justify-center gap-2": "",
                },

                // 📄 Componentes de Paginación
                ".pagination-container": {
                    "@apply px-6 py-4 border-t border-sena-gris/30 bg-gradient-to-r from-sena-gris/30 to-sena-gris/20 backdrop-blur-xs":
                        "",
                },

                ".pagination-info": {
                    "@apply text-sm text-sena-azul/70 font-secondary": "",
                },

                ".pagination-selector": {
                    "@apply px-3 py-1 text-sm rounded-md border border-sena-gris/50 shadow-neumorph-inset bg-white/80 text-sena-azul focus:outline-none focus:ring-2 focus:ring-sena-verde/20 focus:border-sena-verde transition-all duration-200":
                        "",
                },

                // 🎨 Componentes de Utilidades
                ".search-highlight": {
                    "@apply bg-sena-amarillo/30 px-1 py-0.5 rounded text-sena-azul-800 font-medium":
                        "",
                },

                ".empty-state": {
                    "@apply px-6 py-12 text-center": "",
                },

                ".empty-state-icon": {
                    "@apply w-16 h-16 mx-auto mb-4 text-sena-azul/40": "",
                },

                ".empty-state-title": {
                    "@apply mb-2 text-lg font-medium text-sena-azul font-sans":
                        "",
                },

                ".empty-state-description": {
                    "@apply mb-4 text-sena-azul/70 font-secondary": "",
                },

                ".glass-overlay": {
                    "@apply absolute inset-0 bg-white/20 backdrop-blur-xs rounded-xl":
                        "",
                    "backdrop-filter": "blur(8px)",
                },

                // 🔧 Componentes de Formulario (actualizados)
                ".form-input": {
                    "@apply block w-full rounded-lg border-sena-gris/50 shadow-neumorph-inset bg-white/80 text-sm text-sena-azul placeholder-sena-azul/50 focus:border-sena-verde focus:ring-sena-verde/20 focus:shadow-sena-subtle transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed":
                        "",
                },

                ".form-checkbox": {
                    "@apply h-5 w-5 text-sena-verde border-sena-gris/50 rounded shadow-neumorph-inset focus:ring focus:ring-sena-verde/20 focus:ring-opacity-50 focus:outline-none transition-all duration-200":
                        "",
                },

                ".form-label": {
                    "@apply block text-sm font-medium text-sena-azul cursor-pointer font-secondary":
                        "",
                },

                ".form-description": {
                    "@apply text-xs text-sena-azul/60 mt-1 font-secondary": "",
                },

                ".form-error": {
                    "@apply mt-1 text-sm text-red-600 font-secondary": "",
                },

                // 📝 Componentes legales existentes (mejorados)
                ".section-legal": {
                    "@apply w-full max-w-screen-xl mx-auto px-6 py-8 font-sans text-sena-azul bg-sena-blanco":
                        "",
                },
                ".section-legal p": {
                    "@apply mb-4 leading-relaxed text-justify": "",
                },
                ".section-legal ul": {
                    "@apply pl-4 mb-4 list-disc list-inside": "",
                },
                ".section-legal table": {
                    "@apply w-full mb-6 text-sm text-left border border-sena-gris/50 shadow-neumorph rounded-lg overflow-hidden":
                        "",
                },
                ".section-legal th": {
                    "@apply px-4 py-2 text-white bg-gradient-to-r from-sena-verde to-sena-verde-sec font-secondary":
                        "",
                },
                ".section-legal td": {
                    "@apply px-4 py-2 text-sena-azul border-t border-sena-gris/30 bg-white/80":
                        "",
                },
                ".section-legal h2": {
                    "@apply mt-6 mb-2 text-xl font-bold text-sena-verde font-sans":
                        "",
                },
                ".section-legal h3": {
                    "@apply mt-4 mb-2 text-lg font-semibold text-sena-azul font-sans":
                        "",
                },
                ".section-legal .header": {
                    "@apply text-center pb-6 mb-8 border-b-4 border-sena-verde":
                        "",
                },
                ".section-legal .header h1": {
                    "@apply mb-2 text-2xl font-bold text-sena-azul font-sans":
                        "",
                },
                ".section-legal .header h2": {
                    "@apply mb-2 text-xl font-semibold text-sena-verde-sec font-sans":
                        "",
                },

                ".legal-notice": {
                    "@apply p-4 mb-4 border rounded-lg shadow-neumorph bg-white/80 border-sena-verde/20":
                        "",
                },

                ".consent-summary": {
                    "@apply p-6 mt-8 border rounded-xl shadow-neumorph-inset bg-white/80 border-sena-verde/30":
                        "",
                },

                ".footer": {
                    "@apply mt-6 text-xs text-center text-sena-azul/60 font-secondary":
                        "",
                },

                // 🎯 Estados de accesibilidad
                "&:focus-visible": {
                    "@apply outline-none ring-2 ring-sena-verde/20 ring-offset-2":
                        "",
                },

                '&[aria-pressed="true"]': {
                    "@apply bg-sena-verde-sec ring-2 ring-sena-amarillo shadow-neumorph-inset":
                        "",
                },

                // 🎬 Animaciones suaves
                ".animate-enter": {
                    "@apply animate-fade-in": "",
                },

                ".animate-slide": {
                    "@apply animate-slide-in": "",
                },

                ".animate-pulse-soft": {
                    "@apply animate-pulse-soft": "",
                },

                // 📱 Responsive helpers
                ".touch-friendly": {
                    "@apply min-h-touch min-w-touch": "",
                },

                ".glass-backdrop": {
                    "@apply backdrop-blur-xs bg-white/70": "",
                    "backdrop-filter": "blur(8px)",
                },
            });
        }),
    ],
};

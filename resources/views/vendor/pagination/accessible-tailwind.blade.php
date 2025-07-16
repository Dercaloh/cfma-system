{{--
    Componente de Paginación SGPTI - CFMA-SENA
    Cumple con WCAG 2.1 AA, Resolución 1122/2023
    Diseño: Light Neumorphism + Estética Institucional SENA
    Clasificación: Información Pública (navegación)
--}}

@if ($paginator->hasPages())
    <nav role="navigation"
         aria-label="Navegación de páginas - Resultados {{ $paginator->firstItem() ?? 0 }} a {{ $paginator->lastItem() ?? 0 }} de {{ $paginator->total() }}"
         class="flex items-center justify-between px-4 py-6 sm:px-6">

        {{-- Información de resultados siempre visible --}}
        <div class="flex items-center space-x-2 text-sm text-gray-600">
            <span class="inline-flex items-center px-3 py-1 border border-gray-200 rounded-full shadow-inner bg-gray-50">
                <svg class="w-4 h-4 mr-1.5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">{{ $paginator->firstItem() ?? 0 }}</span>
                <span class="mx-1">-</span>
                <span class="font-medium">{{ $paginator->lastItem() ?? 0 }}</span>
                <span class="mx-1">de</span>
                <span class="font-medium text-blue-700">{{ $paginator->total() }}</span>
            </span>
            <span class="hidden text-gray-500 sm:inline">registros encontrados</span>
        </div>

        {{-- Navegación móvil --}}
        <div class="flex items-center space-x-2 sm:hidden">
            {{-- Botón anterior móvil --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg shadow-inner cursor-not-allowed"
                      aria-disabled="true">
                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-200 bg-blue-700 border border-blue-800 rounded-lg shadow-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:shadow-xl active:shadow-inner"
                   aria-label="Ir a la página anterior">
                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Anterior
                </a>
            @endif

            {{-- Indicador de página actual móvil --}}
            <span class="inline-flex items-center px-3 py-2 text-sm font-semibold text-blue-700 border border-blue-200 rounded-lg shadow-inner bg-blue-50">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

            {{-- Botón siguiente móvil --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-200 bg-blue-700 border border-blue-800 rounded-lg shadow-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:shadow-xl active:shadow-inner"
                   aria-label="Ir a la página siguiente">
                    Siguiente
                    <svg class="w-4 h-4 ml-1.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg shadow-inner cursor-not-allowed"
                      aria-disabled="true">
                    Siguiente
                    <svg class="w-4 h-4 ml-1.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
            @endif
        </div>

        {{-- Navegación de escritorio --}}
        <div class="hidden sm:flex sm:items-center sm:space-x-1">
            {{-- Botón primera página --}}
            @if ($paginator->currentPage() > 2)
                <a href="{{ $paginator->url(1) }}"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:shadow-lg"
                   aria-label="Ir a la primera página">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 9H17a1 1 0 110 2h-5.586l4.293 4.293a1 1 0 010 1.414zM6 4a1 1 0 011 1v10a1 1 0 11-2 0V5a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Primera
                </a>
            @endif

            {{-- Botón anterior --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg shadow-inner cursor-not-allowed"
                      aria-disabled="true">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:shadow-lg"
                   aria-label="Ir a la página anterior">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Anterior
                </a>
            @endif

            {{-- Números de página --}}
            <div class="flex items-center px-2 space-x-1">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg shadow-inner bg-gray-50"
                              aria-disabled="true">
                            {{ $element }}
                        </span>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page"
                                      class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-700 border border-blue-800 rounded-lg shadow-lg ring-2 ring-blue-500 ring-offset-2">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:shadow-lg"
                                   aria-label="Ir a la página {{ $page }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Botón siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:shadow-lg"
                   aria-label="Ir a la página siguiente">
                    Siguiente
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            @else
                <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg shadow-inner cursor-not-allowed"
                      aria-disabled="true">
                    Siguiente
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
            @endif

            {{-- Botón última página --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                <a href="{{ $paginator->url($paginator->lastPage()) }}"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:shadow-lg"
                   aria-label="Ir a la última página">
                    Última
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414-1.414L8.586 11H3a1 1 0 110-2h5.586L4.293 5.707a1 1 0 010-1.414zM14 4a1 1 0 011 1v10a1 1 0 11-2 0V5a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                </a>
            @endif
        </div>
    </nav>

    {{-- Indicador de carga para navegación vía AJAX (opcional) --}}
    <div id="pagination-loader" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-25">
        <div class="flex items-center p-6 space-x-3 bg-white rounded-lg shadow-xl">
            <div class="w-6 h-6 border-2 border-blue-700 rounded-full animate-spin border-t-transparent"></div>
            <span class="text-sm font-medium text-gray-700">Cargando página...</span>
        </div>
    </div>
@else
    {{-- Mensaje cuando no hay páginas --}}
    <div class="flex items-center justify-center py-4">
        <div class="inline-flex items-center px-4 py-2 text-sm text-gray-500 border border-gray-200 rounded-lg shadow-inner bg-gray-50">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            @if($paginator->total() == 0)
                No hay registros para mostrar
            @else
                Mostrando {{ $paginator->total() }} registro{{ $paginator->total() > 1 ? 's' : '' }}
            @endif
        </div>
    </div>
@endif

{{-- Estilos adicionales para mejor integración con el tema SENA --}}
<style>
    /* Mejoras específicas para accesibilidad y neumorphism */
    nav[aria-label*="Navegación"] {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow:
            0 4px 6px -1px rgba(0, 0, 0, 0.1),
            0 2px 4px -1px rgba(0, 0, 0, 0.06),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }

    /* Estados de focus mejorados para accesibilidad */
    nav a:focus-visible,
    nav span:focus-visible {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
        box-shadow:
            0 0 0 2px rgba(59, 130, 246, 0.1),
            0 0 0 4px rgba(59, 130, 246, 0.2);
    }

    /* Animaciones suaves para transiciones */
    nav a {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Indicadores de estado mejorados */
    nav span[aria-current="page"] {
        position: relative;
        z-index: 10;
    }

    nav span[aria-current="page"]::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, #3b82f6, #1d4ed8);
        border-radius: 10px;
        z-index: -1;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    /* Mejoras para modo oscuro (preparación futura) */
    @media (prefers-color-scheme: dark) {
        nav[aria-label*="Navegación"] {
            background: linear-gradient(145deg, #1f2937 0%, #111827 100%);
            border-color: #374151;
        }
    }

    /* Mejoras para impresión */
    @media print {
        nav[aria-label*="Navegación"] {
            display: none;
        }
    }
</style>

{{-- Script para funcionalidad opcional de carga --}}
<script>
    // Opcional: Mostrar indicador de carga durante navegación
    document.addEventListener('DOMContentLoaded', function() {
        const paginationLinks = document.querySelectorAll('nav[aria-label*="Navegación"] a');
        const loader = document.getElementById('pagination-loader');

        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (loader) {
                    loader.classList.remove('hidden');
                }
            });
        });
    });
</script>

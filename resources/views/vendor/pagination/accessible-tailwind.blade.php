@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginación de resultados" class="flex items-center justify-between px-4 py-3 sm:px-6">
        <div class="flex justify-between flex-1 sm:hidden">
            {{-- Botones móviles --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm text-gray-500 bg-gray-100 rounded-md cursor-default">Anterior</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-4 py-2 text-sm text-blue-700 bg-white border border-gray-300 rounded-md hover:bg-blue-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                   aria-label="Ir a la página anterior">Anterior</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-4 py-2 ml-3 text-sm text-blue-700 bg-white border border-gray-300 rounded-md hover:bg-blue-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                   aria-label="Ir a la página siguiente">Siguiente</a>
            @else
                <span class="px-4 py-2 ml-3 text-sm text-gray-500 bg-gray-100 rounded-md cursor-default">Siguiente</span>
            @endif
        </div>

        {{-- Versión escritorio --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-600">
                    Mostrando
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    a
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    de
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    resultados
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-md shadow-sm" role="group">
                    {{-- Botón anterior --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="Anterior">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md" aria-hidden="true">
                                &laquo;
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                           class="relative inline-flex items-center px-2 py-2 text-sm text-blue-700 bg-white border border-gray-300 hover:bg-blue-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-l-md"
                           aria-label="Ir a la página anterior">
                            &laquo;
                        </a>
                    @endif

                    {{-- Números de página --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm text-gray-700 bg-white border border-gray-300 cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative z-10 inline-flex items-center px-4 py-2 -ml-px text-sm font-semibold text-white bg-blue-700 border border-blue-700">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                       class="relative inline-flex items-center px-4 py-2 -ml-px text-sm text-blue-700 bg-white border border-gray-300 hover:bg-blue-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       aria-label="Ir a la página {{ $page }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Botón siguiente --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"
                           class="relative inline-flex items-center px-2 py-2 -ml-px text-sm text-blue-700 bg-white border border-gray-300 hover:bg-blue-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-r-md"
                           aria-label="Ir a la página siguiente">
                            &raquo;
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="Siguiente">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md" aria-hidden="true">
                                &raquo;
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

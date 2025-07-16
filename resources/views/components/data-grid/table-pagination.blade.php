{{--
    Componente: Paginación Avanzada - SGPTI SENA
    Ubicación: resources/views/components/data-grid/table-pagination.blade.php
    Propósito: Paginación completa con navegación accesible y responsiva
    Autor: Sistema SGPTI - CFMA SENA
    Versión: 1.0
    Cumplimiento: WCAG 2.1 AA, ISO 27001, Res. 1122/2023
--}}

@props([
    'paginator' => null,
    'perPage' => 10,
    'showPerPage' => true,
    'showInfo' => true,
    'showJumper' => true,
    'maxLinks' => 7,
    'compact' => false,
    'theme' => 'sena'
])

@php
    $currentPage = $paginator->currentPage();
    $lastPage = $paginator->lastPage();
    $total = $paginator->total();
    $from = $paginator->firstItem();
    $to = $paginator->lastItem();
    $perPageOptions = [10, 25, 50, 100];

    // Calcular rango de páginas a mostrar
    $start = max(1, $currentPage - floor($maxLinks / 2));
    $end = min($lastPage, $start + $maxLinks - 1);
    $start = max(1, $end - $maxLinks + 1);
@endphp

<div class="flex flex-col items-center justify-between gap-4 p-4 bg-white border rounded-lg sm:flex-row shadow-neumorph border-sena-gris-200">
    {{-- Información de resultados --}}
    @if($showInfo && !$compact)
        <div class="flex items-center gap-2 text-sm text-sena-gris-600">
            <x-heroicon-o-information-circle class="w-4 h-4" />
            <span>
                Mostrando <span class="font-semibold text-sena-verde">{{ number_format($from) }}</span>
                a <span class="font-semibold text-sena-verde">{{ number_format($to) }}</span>
                de <span class="font-semibold text-sena-verde">{{ number_format($total) }}</span> resultados
            </span>
        </div>
    @endif

    {{-- Navegación principal --}}
    <div class="flex items-center gap-2">
        {{-- Botón Primera Página --}}
        @if($currentPage > 1)
            <a href="{{ $paginator->url(1) }}"
               class="btn-pagination"
               title="Primera página"
               aria-label="Ir a la primera página">
                <x-heroicon-o-chevron-double-left class="w-4 h-4" />
            </a>
        @endif

        {{-- Botón Anterior --}}
        @if($paginator->onFirstPage())
            <span class="btn-pagination-disabled" aria-disabled="true">
                <x-heroicon-o-chevron-left class="w-4 h-4" />
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="btn-pagination"
               title="Página anterior"
               aria-label="Ir a la página anterior">
                <x-heroicon-o-chevron-left class="w-4 h-4" />
            </a>
        @endif

        {{-- Números de página --}}
        @if(!$compact)
            <nav class="flex items-center gap-1" role="navigation" aria-label="Paginación">
                @for($page = $start; $page <= $end; $page++)
                    @if($page == $currentPage)
                        <span class="btn-pagination-active" aria-current="page">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $paginator->url($page) }}"
                           class="btn-pagination"
                           title="Página {{ $page }}"
                           aria-label="Ir a la página {{ $page }}">
                            {{ $page }}
                        </a>
                    @endif
                @endfor
            </nav>
        @else
            <span class="px-2 text-sm text-sena-gris-600">
                {{ $currentPage }} / {{ $lastPage }}
            </span>
        @endif

        {{-- Botón Siguiente --}}
        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="btn-pagination"
               title="Página siguiente"
               aria-label="Ir a la página siguiente">
                <x-heroicon-o-chevron-right class="w-4 h-4" />
            </a>
        @else
            <span class="btn-pagination-disabled" aria-disabled="true">
                <x-heroicon-o-chevron-right class="w-4 h-4" />
            </span>
        @endif

        {{-- Botón Última Página --}}
        @if($currentPage < $lastPage)
            <a href="{{ $paginator->url($lastPage) }}"
               class="btn-pagination"
               title="Última página"
               aria-label="Ir a la última página">
                <x-heroicon-o-chevron-double-right class="w-4 h-4" />
            </a>
        @endif
    </div>

    {{-- Controles adicionales --}}
    @if(!$compact)
        <div class="flex items-center gap-4">
            {{-- Selector de elementos por página --}}
            @if($showPerPage)
                <div class="flex items-center gap-2">
                    <label for="per-page" class="text-sm text-sena-gris-600">
                        Mostrar:
                    </label>
                    <select id="per-page"
                            class="form-select-sm"
                            onchange="updatePerPage(this.value)">
                        @foreach($perPageOptions as $option)
                            <option value="{{ $option }}"
                                    {{ $perPage == $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            {{-- Salto rápido a página --}}
            @if($showJumper && $lastPage > 10)
                <div class="flex items-center gap-2">
                    <label for="page-jump" class="text-sm text-sena-gris-600">
                        Ir a:
                    </label>
                    <input type="number"
                           id="page-jump"
                           class="w-16 form-input-sm"
                           min="1"
                           max="{{ $lastPage }}"
                           placeholder="{{ $currentPage }}"
                           onkeypress="handlePageJump(event, {{ $lastPage }})">
                </div>
            @endif
        </div>
    @endif
</div>

<style>
.btn-pagination {
    @apply px-3 py-2 text-sm font-medium text-sena-gris-700 bg-white border border-sena-gris-300 rounded-lg hover:bg-sena-gris-50 hover:border-sena-verde hover:text-sena-verde focus:outline-none focus:ring-2 focus:ring-sena-verde focus:ring-offset-2 transition-all duration-200;
}

.btn-pagination-active {
    @apply px-3 py-2 text-sm font-medium text-white bg-sena-verde border border-sena-verde rounded-lg shadow-sm;
}

.btn-pagination-disabled {
    @apply px-3 py-2 text-sm font-medium text-sena-gris-400 bg-sena-gris-100 border border-sena-gris-200 rounded-lg cursor-not-allowed;
}

.form-select-sm {
    @apply px-3 py-1.5 text-sm border border-sena-gris-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sena-verde focus:border-sena-verde;
}

.form-input-sm {
    @apply px-3 py-1.5 text-sm border border-sena-gris-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sena-verde focus:border-sena-verde;
}
</style>

<script>
function updatePerPage(value) {
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', value);
    url.searchParams.set('page', 1);
    window.location.href = url.toString();
}

function handlePageJump(event, maxPage) {
    if (event.key === 'Enter') {
        const page = parseInt(event.target.value);
        if (page >= 1 && page <= maxPage) {
            const url = new URL(window.location.href);
            url.searchParams.set('page', page);
            window.location.href = url.toString();
        } else {
            event.target.value = '';
            alert(`Por favor ingrese un número entre 1 y ${maxPage}`);
        }
    }
}

// Navegación por teclado
document.addEventListener('keydown', function(e) {
    if (e.altKey) {
        switch(e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                const prevBtn = document.querySelector('a[aria-label="Ir a la página anterior"]');
                if (prevBtn) prevBtn.click();
                break;
            case 'ArrowRight':
                e.preventDefault();
                const nextBtn = document.querySelector('a[aria-label="Ir a la página siguiente"]');
                if (nextBtn) nextBtn.click();
                break;
        }
    }
});
</script>

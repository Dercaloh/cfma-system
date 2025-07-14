{{-- resources/views/components/filters/search-filter-form.blade.php --}}
@props([
    'route' => 'asset-types.index',
    'searchValue' => '',
    'statusValue' => '',
    'perPageValue' => 25
])

<div class="p-6 mb-8 bg-white shadow-lg rounded-xl">
    <form method="GET" action="{{ route($route) }}" class="space-y-4">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            {{-- Búsqueda --}}
            <div class="lg:col-span-2">
                <x-fields.input-field
                    name="search"
                    label="Buscar tipos de activos"
                    placeholder="Buscar por nombre o descripción..."
                    value="{{ $searchValue }}"
                    icon="search"
                    class="{{ $searchValue ? 'filter-active' : '' }}"
                />
            </div>

            {{-- Filtro por estado --}}
            <div>
                <x-fields.select-field
                    name="status"
                    label="Estado"
                    :options="[
                        '' => 'Todos los estados',
                        'active' => 'Activos',
                        'inactive' => 'Inactivos'
                    ]"
                    value="{{ $statusValue }}"
                    class="{{ $statusValue ? 'filter-active' : '' }}"
                />
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-2">
                <x-buttons.primary-button type="submit">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Buscar
                </x-buttons.primary-button>

                @if($searchValue || $statusValue)
                    <a href="{{ route($route) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Limpiar
                    </a>
                @endif
            </div>

            {{-- Resultados por página --}}
            <x-filters.results-per-page-selector :value="$perPageValue" />
        </div>
    </form>
</div>

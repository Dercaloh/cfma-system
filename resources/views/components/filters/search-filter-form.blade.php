{{-- resources/views/components/filters/search-filter-form.blade.php --}}
@props([
    'route' => 'asset-types.index',
    'searchValue' => '',
    'statusValue' => '',
    'perPageValue' => 25,
    'perPageOptions' => [10, 25, 50, 100],
])

<div class="p-6 mb-8 bg-white shadow-lg rounded-xl">
    <form method="GET" action="{{ route($route) }}" class="space-y-4">
        {{-- Filtros principales --}}
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            {{-- Búsqueda --}}
            <div class="lg:col-span-2">
                <x-fields.input-field name="search" label="Buscar tipos de activos"
                    placeholder="Buscar por nombre o descripción..." value="{{ $searchValue }}" icon="search"
                    class="{{ $searchValue ? 'filter-active' : '' }}" />
            </div>

            {{-- Filtro por estado --}}
            <div>
                <x-fields.select-field name="status" label="Estado" :options="[
                    '' => 'Todos los estados',
                    'active' => 'Activos',
                    'inactive' => 'Inactivos',
                ]" value="{{ $statusValue }}"
                    class="{{ $statusValue ? 'filter-active' : '' }}" />
            </div>
        </div>

        {{-- Acciones y selector de cantidad --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-2">
                <x-buttons.primary-button type="submit">
                    <x-heroicon-o-magnifying-glass class="w-4 h-4 mr-2" />
                    Buscar
                </x-buttons.primary-button>

                @if ($searchValue || $statusValue)
                    <a href="{{ route($route) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                        <x-heroicon-o-x-mark class="w-4 h-4" />
                        Limpiar
                    </a>
                @endif
            </div>

            {{-- Resultados por página (sin duplicar info de paginación) --}}
            <div class="relative inline-block min-w-[220px]">
                <select name="per_page" id="per_page" class="pr-10 appearance-none filter-select"
                    aria-label="Seleccionar resultados por página">
                    @foreach ($perPageOptions as $option)
                        <option value="{{ $option }}" @selected($perPageValue == $option)>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>

                <div class="absolute inset-y-0 flex items-center pointer-events-none right-3 text-sena-azul/70">
                    <x-heroicon-o-chevron-down class="w-5 h-5" />
                </div>
            </div>


        </div>
    </form>
</div>

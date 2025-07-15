<x-app-layout>
    <x-slot name="header">
        <x-layout.section-header icon="archive-box" color="blue" title="Tipos de Activos"
            subtitle="Gestión de categorías de activos tecnológicos">
            <x-slot name="actions">
                @can('gestionar tipos de activos')
                    <x-buttons.link-button href="{{ route('admin.tipos_activos.create') }}" icon="plus"
                        text="Crear Tipo de Activo" class="btn-sena" />
                @endcan
            </x-slot>
        </x-layout.section-header>
    </x-slot>

    {{-- Estadísticas --}}
    <div class="flex flex-wrap justify-between gap-4 sm:justify-start">
        <x-stats.stats-card title="Total Tipos" value="{{ $assetTypes->total() }}" icon="archive-box" color="blue"
            trend="+2 hoy" />
        <x-stats.stats-card title="Activos" value="{{ $stats['active'] ?? 0 }}" icon="check-circle" color="green"
            trend="+1 hoy" />
        <x-stats.stats-card title="Inactivos" value="{{ $stats['inactive'] ?? 0 }}" icon="x-circle" color="red"
            trend="0" trendDirection="down" />
        <x-stats.stats-card title="Creados Hoy" value="{{ $stats['today'] ?? 0 }}" icon="clock" color="purple"
            trend="+2" />
    </div>

    {{-- Filtros y búsqueda --}}
    <div class="p-6 mb-8 bg-white shadow-lg rounded-xl">
        <form method="GET" action="{{ route('admin.tipos_activos.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <x-fields.input-field name="search" label="Buscar tipos de activos"
                        placeholder="Buscar por nombre o descripción..." value="{{ request('search') }}" icon="search"
                        class="{{ request('search') ? 'filter-active' : '' }}" />
                </div>
                <div>
                    <x-fields.select-field name="status" label="Estado" :options="[
                        '' => 'Todos los estados',
                        'active' => 'Activos',
                        'inactive' => 'Inactivos',
                    ]"
                        value="{{ request('status') }}" class="{{ request('status') ? 'filter-active' : '' }}" />
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-2">
                    <x-buttons.primary-button type="submit">
                        <x-heroicon-o-magnifying-glass class="w-4 h-4 mr-2" />
                        Buscar
                    </x-buttons.primary-button>

                    @if (request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.tipos_activos.index') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                            <x-heroicon-o-x-mark class="w-4 h-4" />
                            Limpiar
                        </a>
                    @endif
                </div>

                <x-filters.results-per-page-selector :current="request('per_page', 25)" :options="[10, 25, 50, 100]" />
            </div>
        </form>
    </div>

    {{-- Tabla --}}
    @if ($assetTypes->count())
        <x-table.asset-types-table :asset-types="$assetTypes" :search-term="request('search')" />

        {{-- Paginación única --}}

        @if ($assetTypes->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $assetTypes->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <x-table.empty-state>
            <x-slot name="icon">
                <x-heroicon-o-archive-box class="w-6 h-6" />
            </x-slot>
            <x-slot name="title">
                {{ request()->hasAny(['search', 'status']) ? 'No se encontraron resultados' : 'No hay tipos de activos registrados' }}
            </x-slot>
            <x-slot name="message">
                {{ request()->hasAny(['search', 'status'])
                    ? 'No hay tipos de activos que coincidan con los criterios de búsqueda actuales.'
                    : 'Comienza creando tu primer tipo de activo para organizar el inventario.' }}
            </x-slot>
            <x-slot name="action">
                @if (request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.tipos_activos.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                        Ver todos los tipos
                    </a>
                @else
                    @can('gestionar tipos de activos')
                        <a href="{{ route('admin.tipos_activos.create') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                            <x-heroicon-o-plus class="w-5 h-5" />
                            Crear primer tipo de activo
                        </a>
                    @endcan
                @endif
            </x-slot>
        </x-table.empty-state>
    @endif

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const select = document.querySelector('form select[name="per_page"]');
                if (select) {
                    select.addEventListener('change', () => {
                        // Si el formulario no incluye search/status, agrégalos dinámicamente
                        const form = select.closest('form');
                        if (form) {
                            // Garantiza que no se pierdan filtros al cambiar per_page
                            const urlParams = new URLSearchParams(window.location.search);
                            ['search', 'status'].forEach(param => {
                                if (urlParams.has(param) && !form.querySelector(`[name="${param}"]`)) {
                                    const hidden = document.createElement('input');
                                    hidden.type = 'hidden';
                                    hidden.name = param;
                                    hidden.value = urlParams.get(param);
                                    form.appendChild(hidden);
                                }
                            });
                            form.submit();
                        }
                    });
                }
            });
        </script>
    @endpush


</x-app-layout>

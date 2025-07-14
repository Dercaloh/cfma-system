<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="flex items-center justify-center w-12 h-12 shadow-lg bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tipos de Activos</h1>
                    <p class="text-sm text-gray-600">Gestión de categorías de activos tecnológicos</p>
                </div>
            </div>
            @can('gestionar tipos de activos')
                <a href="{{ route('admin.tipos_activos.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 action-button">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Crear Tipo de Activo
                </a>
            @endcan
        </div>
    </x-slot>

    {{-- Estadísticas --}}
    <div class="flex flex-wrap justify-between gap-4 sm:justify-start">
    <x-stats.stats-card title="Total Tipos" value="{{ $assetTypes->total() }}" icon="archive-box" color="blue" trend="+2 hoy" />
    <x-stats.stats-card title="Activos" value="{{ $stats['active'] ?? 0 }}" icon="check-circle" color="green" trend="+1 hoy" />
    <x-stats.stats-card title="Inactivos" value="{{ $stats['inactive'] ?? 0 }}" icon="x-circle" color="red" trend="0" trendDirection="down" />
    <x-stats.stats-card title="Creados Hoy" value="{{ $stats['today'] ?? 0 }}" icon="clock" color="purple" trend="+2" />
</div>




    {{-- Filtros y Búsqueda --}}
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
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Buscar
                    </x-buttons.primary-button>

                    @if (request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.tipos_activos.index') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
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
        <x-table.asset-types-table :asset-types="$assetTypes" :search-term="request('search')">
            <x-slot name="header">
                <x-table.table-header>
                    <th class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        <x-ui.sortable-header sort-key="name" :current-sort="request('sort')" :current-direction="request('direction', 'asc')" :base-url="route('admin.tipos_activos.index')"
                            :query-params="request()->except(['sort', 'direction'])">
                            Nombre
                        </x-ui.sortable-header>
                    </th>
                    <th class="px-6 py-4 text-xs font-medium text-left text-gray-500 uppercase">Descripción</th>
                    <th class="px-6 py-4 text-xs font-medium text-left text-gray-500 uppercase">Estado</th>
                    <th class="px-6 py-4 text-xs font-medium text-left text-gray-500 uppercase">
                        <x-ui.sortable-header sort-key="created_at" :current-sort="request('sort')" :current-direction="request('direction', 'asc')"
                            :base-url="route('admin.tipos_activos.index')" :query-params="request()->except(['sort', 'direction'])">
                            Creado
                        </x-ui.sortable-header>
                    </th>
                    <th class="px-6 py-4 text-xs font-medium text-center text-gray-500 uppercase">Acciones</th>
                </x-table.table-header>
            </x-slot>

            <x-slot name="body">
                @foreach ($assetTypes as $assetType)
                    <x-table.table-row :asset-type="$assetType" :search-term="request('search')" class="table-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        <x-ui.search-highlight :text="$assetType->name" :search="request('search')"
                                            class="search-highlight" />
                                    </div>
                                    <div class="text-sm text-gray-500">ID: {{ $assetType->id }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="max-w-xs px-6 py-4 text-sm text-gray-900 truncate">
                            <x-ui.search-highlight :text="$assetType->description ?? 'Sin descripción'" :search="request('search')" />
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-ui.status-badge :active="$assetType->active" />
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span>{{ $assetType->created_at->format('d/m/Y') }}</span>
                                <span class="text-xs text-gray-400">{{ $assetType->created_at->format('H:i') }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                            <x-buttons.action-buttons-group :asset-type="$assetType" />
                        </td>
                    </x-table.table-row>
                @endforeach
            </x-slot>
        </x-table.asset-types-table>

        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                <x-pagination.pagination-info :paginator="$assetTypes" />
                {{ $assetTypes->appends(request()->query())->links() }}
            </div>
        </div>
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
                const perPageSelect = document.querySelector('[name="per_page"]');
                if (perPageSelect) {
                    perPageSelect.addEventListener('change', () => {
                        perPageSelect.form?.submit();
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>

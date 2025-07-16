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
                {{-- Campo de búsqueda --}}
                <div class="lg:col-span-2">
                    <x-fields.input-field name="search" label="Buscar tipos de activos"
                        placeholder="Buscar por nombre o descripción..." value="{{ request('search') }}" icon="search"
                        class="{{ request('search') ? 'filter-active' : '' }}" />
                </div>

                {{-- Estado --}}
                <div>
                    <x-fields.select-field name="status" label="Estado" :options="[
                        '' => 'Todos los estados',
                        'active' => 'Activos',
                        'inactive' => 'Inactivos',
                    ]"
                        value="{{ request('status') }}" class="{{ request('status') ? 'filter-active' : '' }}" />
                </div>
            </div>

            {{-- Checkbox mostrar eliminados + botones --}}
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-4">
                    <label class="inline-flex items-center gap-2 text-sm text-sena-gris-oscuro">
                        <input type="checkbox" name="show_deleted" value="1"
                            class="form-checkbox text-sena-verde focus:ring-sena-verde"
                            {{ request()->boolean('show_deleted') ? 'checked' : '' }}>
                        Mostrar eliminados ({{ $stats['deleted'] ?? 0 }})
                    </label>

                    <x-buttons.primary-button type="submit">
                        <x-heroicon-o-magnifying-glass class="w-4 h-4 mr-2" />
                        Buscar
                    </x-buttons.primary-button>

                    @if (request()->hasAny(['search', 'status', 'show_deleted']))
                        <a href="{{ route('admin.tipos_activos.index') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                            <x-heroicon-o-x-mark class="w-4 h-4" />
                            Limpiar
                        </a>
                    @endif
                </div>

                {{-- Selector de resultados por página --}}
                <x-filters.results-per-page-selector :current="request('per_page', 25)" :options="[10, 25, 50, 100]" />
            </div>
        </form>
    </div>

    {{-- Tabla --}}
    @php
        $searchTerm = request('search');
    @endphp

    @if ($assetTypes->count())
        <div class="overflow-x-auto bg-white shadow-sm rounded-xl">
            <table class="w-full text-sm text-left table-auto text-sena-gris-oscuro">
                <thead class="text-xs font-semibold text-sena-azul bg-sena-gris-claro/40">
                    <tr>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Descripción</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Fecha creación</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($assetTypes as $assetType)
                        <tr class="transition-colors hover:bg-gray-50">
                            {{-- Nombre --}}
                            <td class="px-6 py-4 font-medium">
                                @if ($searchTerm)
                                    {!! str_ireplace($searchTerm, '<mark class="px-1 bg-yellow-200 rounded">' . $searchTerm . '</mark>', e($assetType->name)) !!}
                                @else
                                    {{ $assetType->name }}
                                @endif
                            </td>

                            {{-- Descripción --}}
                            <td class="max-w-xs px-6 py-4">
                                @if ($assetType->description)
                                    <div class="truncate" title="{{ $assetType->description }}">
                                        @if ($searchTerm)
                                            {!! str_ireplace($searchTerm, '<mark class="px-1 bg-yellow-200 rounded">' . $searchTerm . '</mark>', e($assetType->description)) !!}
                                        @else
                                            {{ $assetType->description }}
                                        @endif
                                    </div>
                                @else
                                    <span class="italic text-gray-400">Sin descripción</span>
                                @endif
                            </td>

                            {{-- Estado usando el componente status-badge --}}
<td class="px-6 py-4">
    @if ($assetType->trashed())
        <x-ui.status-badge status="cancelled" size="sm" pulse="false" />
    @else
        <x-ui.status-badge
            status="{{ $assetType->is_active ? 'active' : 'inactive' }}"
            size="sm"
            pulse="false"
        />
    @endif
</td>


                            {{-- Fecha creación --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm">{{ $assetType->created_at->format('d/m/Y') }}</span>
                                    <span class="text-xs text-gray-500">{{ $assetType->created_at->format('H:i') }}</span>
                                </div>
                            </td>

                            {{-- Acciones --}}
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if ($assetType->trashed())
                                        {{-- Botones para elementos eliminados --}}
                                        @can('restaurar tipos de activos')
                                            <form method="POST" action="{{ route('admin.tipos_activos.restore', $assetType->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs text-green-700 transition-colors bg-green-100 rounded-lg hover:bg-green-200"
                                                    onclick="return confirm('¿Está seguro de que desea restaurar este tipo de activo?')">
                                                    <x-heroicon-o-arrow-path class="w-4 h-4" />
                                                    Restaurar
                                                </button>
                                            </form>
                                        @endcan

                                        @can('eliminar tipos de activos permanentemente')
                                            <form method="POST" action="{{ route('admin.tipos_activos.force-delete', $assetType->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs text-red-700 transition-colors bg-red-100 rounded-lg hover:bg-red-200"
                                                    onclick="return confirm('¿Está seguro de que desea eliminar permanentemente este tipo de activo? Esta acción no se puede deshacer.')">
                                                    <x-heroicon-o-trash class="w-4 h-4" />
                                                    Eliminar permanentemente
                                                </button>
                                            </form>
                                        @endcan
                                    @else
                                        {{-- Botones para elementos activos --}}
                                        @can('ver tipos de activos')
                                            <a href="{{ route('admin.tipos_activos.show', $assetType) }}"
                                               class="inline-flex items-center gap-1 px-3 py-1 text-xs text-blue-700 transition-colors bg-blue-100 rounded-lg hover:bg-blue-200">
                                                <x-heroicon-o-eye class="w-4 h-4" />
                                                Ver
                                            </a>
                                        @endcan

                                        @can('editar tipos de activos')
                                            <a href="{{ route('admin.tipos_activos.edit', $assetType) }}"
                                               class="inline-flex items-center gap-1 px-3 py-1 text-xs transition-colors rounded-lg text-amber-700 bg-amber-100 hover:bg-amber-200">
                                                <x-heroicon-o-pencil class="w-4 h-4" />
                                                Editar
                                            </a>
                                        @endcan

                                        @can('eliminar tipos de activos')
                                            <form method="POST" action="{{ route('admin.tipos_activos.destroy', $assetType) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs text-red-700 transition-colors bg-red-100 rounded-lg hover:bg-red-200"
                                                    onclick="return confirm('¿Está seguro de que desea eliminar este tipo de activo?')">
                                                    <x-heroicon-o-trash class="w-4 h-4" />
                                                    Eliminar
                                                </button>
                                            </form>
                                        @endcan
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sena-gris-oscuro">
                                No se encontraron tipos de activos con los filtros actuales.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
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
                // Manejo del selector de resultados por página
                const select = document.querySelector('form select[name="per_page"]');
                if (select) {
                    select.addEventListener('change', () => {
                        const form = select.closest('form');
                        if (form) {
                            const urlParams = new URLSearchParams(window.location.search);
                            ['search', 'status', 'show_deleted'].forEach(param => {
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

                // Confirmación para acciones destructivas
                const deleteButtons = document.querySelectorAll('button[onclick*="confirm"]');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', (e) => {
                        if (!confirm(button.getAttribute('onclick').match(/confirm\('([^']+)'\)/)[1])) {
                            e.preventDefault();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>

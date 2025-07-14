@extends('layouts.app')

@section('title', 'Tipos de Activos - SGPTI')

@push('styles')
<style>
    .search-highlight {
        background-color: rgba(249, 195, 0, 0.3);
        padding: 1px 3px;
        border-radius: 3px;
    }

    .stats-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .filter-active {
        background: rgba(34, 197, 94, 0.1);
        border-color: rgba(34, 197, 94, 0.3);
    }

    .action-button {
        transition: all 0.2s ease;
    }

    .action-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .table-row {
        transition: all 0.2s ease;
    }

    .table-row:hover {
        background: rgba(249, 250, 251, 0.8);
        transform: translateX(2px);
    }
</style>
@endpush

<x-layout.app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-12 h-12 shadow-lg bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tipos de Activos</h1>
                    <p class="text-sm text-gray-600">Gestión de categorías de activos tecnológicos</p>
                </div>
            </div>

            @can('gestionar tipos de activos')
                <a href="{{ route('asset-types.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 action-button">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Crear Tipo de Activo
                </a>
            @endcan
        </div>
    </x-slot>

    {{-- Estadísticas --}}
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <div class="p-6 shadow-lg stats-card rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Tipos</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $assetTypes->total() }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="p-6 shadow-lg stats-card rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Activos</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['active'] ?? 0 }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="p-6 shadow-lg stats-card rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Inactivos</p>
                    <p class="text-3xl font-bold text-red-600">{{ $stats['inactive'] ?? 0 }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="p-6 shadow-lg stats-card rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Creados Hoy</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['today'] ?? 0 }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filtros y Búsqueda --}}
    <div class="p-6 mb-8 bg-white shadow-lg rounded-xl">
        <form method="GET" action="{{ route('asset-types.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                {{-- Búsqueda --}}
                <div class="lg:col-span-2">
                    <x-fields.input-field
                        name="search"
                        label="Buscar tipos de activos"
                        placeholder="Buscar por nombre o descripción..."
                        value="{{ request('search') }}"
                        icon="search"
                        class="{{ request('search') ? 'filter-active' : '' }}"
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
                        value="{{ request('status') }}"
                        class="{{ request('status') ? 'filter-active' : '' }}"
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

                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('asset-types.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Limpiar
                        </a>
                    @endif
                </div>

                {{-- Resultados por página --}}
                <div class="flex items-center gap-2">
                    <label for="per_page" class="text-sm text-gray-600">Mostrar:</label>
                    <select name="per_page" id="per_page" onchange="this.form.submit()"
                            class="px-3 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    {{-- Tabla de Tipos de Activos --}}
    <div class="overflow-hidden bg-white shadow-lg rounded-xl">
        @if($assetTypes->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                <a href="{{ route('asset-types.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                                   class="flex items-center gap-1 hover:text-gray-700">
                                    Nombre
                                    @if(request('sort') === 'name')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="{{ request('direction') === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"/>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Descripción
                            </th>
                            <th class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Estado
                            </th>
                            <th class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                <a href="{{ route('asset-types.index', array_merge(request()->query(), ['sort' => 'created_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                                   class="flex items-center gap-1 hover:text-gray-700">
                                    Creado
                                    @if(request('sort') === 'created_at')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="{{ request('direction') === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"/>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($assetTypes as $assetType)
                            <tr class="table-row">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {!! request('search') ?
                                                    preg_replace('/(' . preg_quote(request('search'), '/') . ')/i', '<span class="search-highlight">$1</span>', e($assetType->name)) :
                                                    e($assetType->name)
                                                !!}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID: {{ $assetType->id }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs text-sm text-gray-900 truncate">
                                        {!! request('search') ?
                                            preg_replace('/(' . preg_quote(request('search'), '/') . ')/i', '<span class="search-highlight">$1</span>', e($assetType->description ?? 'Sin descripción')) :
                                            e($assetType->description ?? 'Sin descripción')
                                        !!}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($assetType->active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Activo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span>{{ $assetType->created_at->format('d/m/Y') }}</span>
                                        <span class="text-xs text-gray-400">{{ $assetType->created_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('asset-types.show', $assetType) }}"
                                           class="text-blue-600 hover:text-blue-800 action-button"
                                           title="Ver detalles">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>

                                        @can('gestionar tipos de activos')
                                            <a href="{{ route('asset-types.edit', $assetType) }}"
                                               class="text-yellow-600 hover:text-yellow-800 action-button"
                                               title="Editar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>

                                            <form method="POST" action="{{ route('asset-types.destroy', $assetType) }}"
                                                  class="inline-block"
                                                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar este tipo de activo?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 action-button"
                                                        title="Eliminar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                    <div class="text-sm text-gray-700">
                        Mostrando {{ $assetTypes->firstItem() ?? 0 }} a {{ $assetTypes->lastItem() ?? 0 }} de {{ $assetTypes->total() }} resultados
                    </div>

                    {{ $assetTypes->appends(request()->query())->links() }}
                </div>
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>

                @if(request()->hasAny(['search', 'status']))
                    <h3 class="mb-2 text-lg font-medium text-gray-900">No se encontraron resultados</h3>
                    <p class="mb-4 text-gray-500">No hay tipos de activos que coincidan con los criterios de búsqueda actuales.</p>
                    <a href="{{ route('asset-types.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                        Ver todos los tipos
                    </a>
                @else
                    <h3 class="mb-2 text-lg font-medium text-gray-900">No hay tipos de activos registrados</h3>
                    <p class="mb-4 text-gray-500">Comienza creando tu primer tipo de activo para organizar el inventario.</p>
                    @can('gestionar tipos de activos')
                        <a href="{{ route('asset-types.create') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Crear primer tipo de activo
                        </a>
                    @endcan
                @endif
            </div>
        @endif
    </div>
</x-layout.app-layout>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-submit del formulario al cambiar per_page
        const perPageSelect = document.getElementById('per_page');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function() {
                this.form.submit();
            });
        }

        // Resaltar términos de búsqueda
        const searchTerm = '{{ request("search") }}';
        if (searchTerm) {
            console.log('Búsqueda activa:', searchTerm);
        }

        // Confirmar eliminación con mensaje personalizado
        const deleteButtons = document.querySelectorAll('form[action*="destroy"] button[type="submit"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const assetTypeName = this.closest('tr').querySelector('td .text-sm.font-medium').textContent.trim();

                if (confirm(`¿Estás seguro de que deseas eliminar el tipo de activo "${assetTypeName}"?\n\nEsta acción no se puede deshacer.`)) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush

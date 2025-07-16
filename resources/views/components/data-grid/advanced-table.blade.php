{{-- resources/views/components/data-grid/advanced-table.blade.php --}}
{{--
SGPTI - Sistema de Gestión de Préstamos de TI
Componente: Tabla Avanzada con Filtros y Exportación
Autor: CFMA-SENA
Versión: 1.0
Accesibilidad: WCAG 2.1 AA
--}}

@props([
    'data' => collect(),
    'columns' => [],
    'searchable' => true,
    'filterable' => true,
    'exportable' => true,
    'selectable' => false,
    'paginate' => 25,
    'title' => 'Tabla de Datos',
    'searchPlaceholder' => 'Buscar...',
    'noDataMessage' => 'No hay datos disponibles',
    'id' => 'advanced-table-' . uniqid(),
    'currentUrl' => null,
    'sortBy' => null,
    'sortDirection' => 'asc',
    'allowedSorts' => [],
])

@php
    $currentUrl = $currentUrl ?? request()->url();
    $tableId = $id;
@endphp

<div class="w-full space-y-4" x-data="advancedTable()" x-init="init()">
    {{-- Encabezado y controles --}}
    <div class="flex flex-col gap-4 mb-6 lg:flex-row lg:items-center lg:justify-between">
        <div class="flex items-center space-x-2">
            <x-heroicon-o-table-cells class="w-6 h-6 text-sena-verde" />
            <h2 class="text-xl font-semibold text-sena-azul">{{ $title }}</h2>
            <span class="text-sm text-gray-500" x-text="'(' + totalRecords + ' registros)'"></span>
        </div>

        {{-- Controles de exportación --}}
        @if ($exportable)
            <div class="flex flex-wrap gap-2">
                <x-buttons.secondary-button x-on:click="exportData('excel')" class="text-sm"
                    aria-label="Exportar a Excel">
                    <x-heroicon-o-document-arrow-down class="w-4 h-4 mr-1" />
                    Excel
                </x-buttons.secondary-button>
                <x-buttons.secondary-button x-on:click="exportData('pdf')" class="text-sm" aria-label="Exportar a PDF">
                    <x-heroicon-o-document-text class="w-4 h-4 mr-1" />
                    PDF
                </x-buttons.secondary-button>
                <x-buttons.secondary-button x-on:click="exportData('csv')" class="text-sm" aria-label="Exportar a CSV">
                    <x-heroicon-o-document class="w-4 h-4 mr-1" />
                    CSV
                </x-buttons.secondary-button>
            </div>
        @endif
    </div>

    {{-- Filtros y búsqueda --}}
    <div class="p-4 space-y-4 card-glass">
        <div class="flex flex-col gap-4 lg:flex-row">
            {{-- Búsqueda global --}}
            @if ($searchable)
                <div class="flex-1">
                    <x-fields.input-field type="text" placeholder="{{ $searchPlaceholder }}" x-model="searchQuery"
                        x-on:input.debounce.300ms="performSearch()" class="w-full" aria-label="Búsqueda global">
                        <x-slot name="prepend">
                            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
                        </x-slot>
                    </x-fields.input-field>
                </div>
            @endif

            {{-- Selector de registros por página --}}
            <div class="flex items-center space-x-2">
                <label for="perPage" class="text-sm font-medium text-gray-700">Mostrar:</label>
                <select id="perPage" x-model="perPage" x-on:change="updatePerPage()"
                    class="w-auto text-sm border-gray-300 rounded-md form-input focus:ring-sena-verde focus:border-sena-verde">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            {{-- Botón de filtros --}}
            @if ($filterable)
                <x-buttons.secondary-button x-on:click="toggleFilters()" class="text-sm"
                    aria-label="Mostrar/ocultar filtros">
                    <x-heroicon-o-funnel class="w-4 h-4 mr-1" />
                    Filtros
                    <x-heroicon-o-chevron-down class="w-4 h-4 ml-1" x-show="!showFilters" />
                    <x-heroicon-o-chevron-up class="w-4 h-4 ml-1" x-show="showFilters" />
                </x-buttons.secondary-button>
            @endif
        </div>

        {{-- Panel de filtros expandible --}}
        @if ($filterable)
            <div x-show="showFilters" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 max-h-96"
                x-transition:leave-end="opacity-0 max-h-0" class="overflow-hidden">
                <div class="grid grid-cols-1 gap-4 p-4 rounded-lg md:grid-cols-2 lg:grid-cols-3 bg-gray-50">
                    @foreach ($columns as $column)
                        @if (isset($column['filterable']) && $column['filterable'])
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">
                                    {{ $column['label'] ?? ucfirst($column['key']) }}
                                </label>
                                @if ($column['filter_type'] === 'select')
                                    <select x-model="filters.{{ $column['key'] }}" x-on:change="applyFilters()"
                                        class="w-full text-sm border-gray-300 rounded-md form-input focus:ring-sena-verde focus:border-sena-verde">
                                        <option value="">Todos</option>
                                        @if (isset($column['filter_options']))
                                            @foreach ($column['filter_options'] as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                @elseif($column['filter_type'] === 'date')
                                    <input type="date" x-model="filters.{{ $column['key'] }}"
                                        x-on:change="applyFilters()"
                                        class="w-full text-sm border-gray-300 rounded-md form-input focus:ring-sena-verde focus:border-sena-verde">
                                @else
                                    <input type="text" x-model="filters.{{ $column['key'] }}"
                                        x-on:input.debounce.300ms="applyFilters()"
                                        class="w-full text-sm border-gray-300 rounded-md form-input focus:ring-sena-verde focus:border-sena-verde"
                                        placeholder="Filtrar por {{ strtolower($column['label'] ?? $column['key']) }}">
                                @endif
                            </div>
                        @endif
                    @endforeach

                    {{-- Botón limpiar filtros --}}
                    <div class="flex items-end">
                        <x-buttons.secondary-button x-on:click="clearFilters()" class="w-full text-sm"
                            aria-label="Limpiar todos los filtros">
                            <x-heroicon-o-x-circle class="w-4 h-4 mr-1" />
                            Limpiar
                        </x-buttons.secondary-button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Tabla responsive --}}
    <div class="overflow-hidden card-glass">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200" role="table" aria-label="{{ $title }}">
                <thead class="bg-gray-50">
                    <tr>
                        {{-- Checkbox para selección múltiple --}}
                        @if ($selectable)
                            <th class="px-6 py-3 text-left">
                                <input type="checkbox" x-model="selectAll" x-on:change="toggleSelectAll()"
                                    class="form-checkbox text-sena-verde focus:ring-sena-verde"
                                    aria-label="Seleccionar todos los registros">
                            </th>
                        @endif

                        {{-- Encabezados de columnas --}}
                        @foreach ($columns as $column)
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                @if (isset($column['sortable']) && $column['sortable'])
                                    <button x-on:click="sortBy('{{ $column['key'] }}')"
                                        class="flex items-center space-x-1 transition-colors hover:text-sena-verde focus:outline-none focus:ring-2 focus:ring-sena-verde focus:ring-offset-2"
                                        aria-label="Ordenar por {{ $column['label'] ?? ucfirst($column['key']) }}">
                                        <span>{{ $column['label'] ?? ucfirst($column['key']) }}</span>
                                        <div class="flex flex-col">
                                            <x-heroicon-o-chevron-up class="w-3 h-3"
                                                x-show="sortColumn === '{{ $column['key'] }}' && sortDirection === 'asc'" />
                                            <x-heroicon-o-chevron-down class="w-3 h-3"
                                                x-show="sortColumn === '{{ $column['key'] }}' && sortDirection === 'desc'" />
                                            <x-heroicon-o-arrows-up-down class="w-3 h-3"
                                                x-show="sortColumn !== '{{ $column['key'] }}'" />
                                        </div>
                                    </button>
                                @else
                                    <span>{{ $column['label'] ?? ucfirst($column['key']) }}</span>
                                @endif
                            </th>
                        @endforeach

                        {{-- Columna de acciones --}}
                        @if ($attributes->has('actions'))
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Acciones
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <template x-for="(row, index) in paginatedData" :key="index">
                        <tr class="transition-colors hover:bg-gray-50">
                            {{-- Checkbox para selección --}}
                            @if ($selectable)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" x-model="selectedRows" :value="row.id"
                                        class="form-checkbox text-sena-verde focus:ring-sena-verde"
                                        :aria-label="'Seleccionar registro ' + (index + 1)">
                                </td>
                            @endif

                            {{-- Datos de las columnas --}}
                            @foreach ($columns as $column)
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    @php
                                        $key = $column['key'];
                                        $badgeType = $column['badge_type'] ?? 'default';
                                    @endphp

                                    @if (isset($column['type']) && $column['type'] === 'badge')
                                        <x-ui.status-badge x-bind:status="row['{{ $key }}']"
                                            type="{{ $badgeType }}" />
                                    @elseif(isset($column['type']) && $column['type'] === 'date')
                                        <span x-text="formatDate(row['{{ $key }}'])"></span>
                                    @elseif(isset($column['type']) && $column['type'] === 'currency')
                                        <span x-text="formatCurrency(row['{{ $key }}'])"></span>
                                    @elseif(isset($column['type']) && $column['type'] === 'image')
                                        <img :src="row['{{ $key }}']"
                                            class="object-cover w-10 h-10 rounded-full"
                                            :alt="'Imagen de ' + (row.name ?? 'Imagen')" loading="lazy">
                                    @else
                                        <span x-text="row['{{ $key }}']"></span>
                                    @endif
                                </td>
                            @endforeach


                            {{-- Acciones --}}
                            @if ($attributes->has('actions'))
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    {{ $actions ?? '' }}
                                </td>
                            @endif
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        {{-- Estado vacío --}}
        <div x-show="filteredData.length === 0" class="py-12 text-center">
            <x-heroicon-o-document class="w-12 h-12 mx-auto mb-4 text-gray-400" />
            <p class="text-gray-500">{{ $noDataMessage }}</p>
        </div>

        {{-- Loading state --}}
        <div x-show="loading" class="py-12 text-center">
            <div class="w-8 h-8 mx-auto border-b-2 rounded-full animate-spin border-sena-verde"></div>
            <p class="mt-2 text-gray-500">Cargando datos...</p>
        </div>
    </div>

    {{-- Paginación --}}
    <div class="flex flex-col items-center justify-between space-y-3 sm:flex-row sm:space-y-0">
        <div class="text-sm text-gray-700">
            Mostrando
            <span x-text="((currentPage - 1) * perPage) + 1"></span> a
            <span x-text="Math.min(currentPage * perPage, totalRecords)"></span> de
            <span x-text="totalRecords"></span> registros
        </div>

        <div class="flex items-center space-x-2">
            <x-buttons.secondary-button x-on:click="previousPage()" :disabled="currentPage === 1" aria-label="Página anterior">
                <x-heroicon-o-chevron-left class="w-4 h-4" />
            </x-buttons.secondary-button>

            <template x-for="page in visiblePages" :key="page">
                <button x-on:click="goToPage(page)"
                    :class="page === currentPage ? 'bg-sena-verde text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                    class="px-3 py-1 text-sm transition-colors border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sena-verde focus:ring-offset-2"
                    x-text="page" :aria-label="'Ir a página ' + page"
                    :aria-current="page === currentPage ? 'page' : null">
                </button>
            </template>

            <x-buttons.secondary-button x-on:click="nextPage()" :disabled="currentPage === totalPages" aria-label="Página siguiente">
                <x-heroicon-o-chevron-right class="w-4 h-4" />
            </x-buttons.secondary-button>
        </div>
    </div>

    {{-- Información de selección --}}
    @if ($selectable)
        <div x-show="selectedRows.length > 0" class="flex items-center justify-between p-4 card-glass">
            <span class="text-sm text-gray-700">
                <span x-text="selectedRows.length"></span> registros seleccionados
            </span>
            <div class="flex space-x-2">
                <x-buttons.secondary-button x-on:click="clearSelection()" class="text-sm"
                    aria-label="Limpiar selección">
                    Limpiar selección
                </x-buttons.secondary-button>
                {{ $bulkActions ?? '' }}
            </div>
        </div>
    @endif
</div>

{{-- JavaScript para funcionalidad --}}
<script>
    function advancedTable() {
        return {
            // Datos y estado
            originalData: @json($data),
            filteredData: @json($data),
            paginatedData: [],
            searchQuery: '',
            filters: {},
            selectedRows: [],
            selectAll: false,
            showFilters: false,
            loading: false,

            // Paginación
            currentPage: 1,
            perPage: {{ $paginate }},
            totalRecords: 0,
            totalPages: 0,
            visiblePages: [],

            // Ordenamiento
            sortColumn: '{{ $sortBy }}',
            sortDirection: '{{ $sortDirection }}',

            // Inicialización
            init() {
                this.totalRecords = this.originalData.length;
                this.calculatePagination();
                this.updatePaginatedData();
                this.initializeFilters();
            },

            // Inicializar filtros
            initializeFilters() {
                const columns = @json($columns);
                columns.forEach(column => {
                    if (column.filterable) {
                        this.filters[column.key] = '';
                    }
                });
            },

            // Búsqueda
            performSearch() {
                this.loading = true;
                setTimeout(() => {
                    this.applyFilters();
                    this.loading = false;
                }, 100);
            },

            // Aplicar filtros
            applyFilters() {
                let filtered = [...this.originalData];

                // Búsqueda global
                if (this.searchQuery) {
                    const query = this.searchQuery.toLowerCase();
                    filtered = filtered.filter(row => {
                        return Object.values(row).some(value =>
                            String(value).toLowerCase().includes(query)
                        );
                    });
                }

                // Filtros por columna
                Object.keys(this.filters).forEach(key => {
                    const filterValue = this.filters[key];
                    if (filterValue) {
                        filtered = filtered.filter(row => {
                            const rowValue = String(row[key]).toLowerCase();
                            return rowValue.includes(filterValue.toLowerCase());
                        });
                    }
                });

                this.filteredData = filtered;
                this.totalRecords = filtered.length;
                this.currentPage = 1;
                this.calculatePagination();
                this.updatePaginatedData();
            },

            // Limpiar filtros
            clearFilters() {
                this.searchQuery = '';
                Object.keys(this.filters).forEach(key => {
                    this.filters[key] = '';
                });
                this.filteredData = [...this.originalData];
                this.totalRecords = this.originalData.length;
                this.currentPage = 1;
                this.calculatePagination();
                this.updatePaginatedData();
            },

            // Ordenamiento
            sortBy(column) {
                if (this.sortColumn === column) {
                    this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sortColumn = column;
                    this.sortDirection = 'asc';
                }

                this.filteredData.sort((a, b) => {
                    let aVal = a[column];
                    let bVal = b[column];

                    // Manejar diferentes tipos de datos
                    if (typeof aVal === 'string') {
                        aVal = aVal.toLowerCase();
                        bVal = bVal.toLowerCase();
                    }

                    if (this.sortDirection === 'asc') {
                        return aVal < bVal ? -1 : aVal > bVal ? 1 : 0;
                    } else {
                        return aVal > bVal ? -1 : aVal < bVal ? 1 : 0;
                    }
                });

                this.updatePaginatedData();
            },

            // Paginación
            calculatePagination() {
                this.totalPages = Math.ceil(this.totalRecords / this.perPage);
                this.updateVisiblePages();
            },

            updateVisiblePages() {
                const delta = 2;
                const range = [];
                const rangeWithDots = [];

                for (let i = Math.max(2, this.currentPage - delta); i <= Math.min(this.totalPages - 1, this
                        .currentPage + delta); i++) {
                    range.push(i);
                }

                if (this.currentPage - delta > 2) {
                    rangeWithDots.push(1, '...');
                } else {
                    rangeWithDots.push(1);
                }

                rangeWithDots.push(...range);

                if (this.currentPage + delta < this.totalPages - 1) {
                    rangeWithDots.push('...', this.totalPages);
                } else {
                    rangeWithDots.push(this.totalPages);
                }

                this.visiblePages = rangeWithDots.filter(page => page !== '...' && page <= this.totalPages);
            },

            updatePaginatedData() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = start + this.perPage;
                this.paginatedData = this.filteredData.slice(start, end);
            },

            goToPage(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                    this.updateVisiblePages();
                    this.updatePaginatedData();
                }
            },

            previousPage() {
                if (this.currentPage > 1) {
                    this.goToPage(this.currentPage - 1);
                }
            },

            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.goToPage(this.currentPage + 1);
                }
            },

            updatePerPage() {
                this.perPage = parseInt(this.perPage);
                this.currentPage = 1;
                this.calculatePagination();
                this.updatePaginatedData();
            },

            // Selección
            toggleSelectAll() {
                if (this.selectAll) {
                    this.selectedRows = this.paginatedData.map(row => row.id);
                } else {
                    this.selectedRows = [];
                }
            },

            clearSelection() {
                this.selectedRows = [];
                this.selectAll = false;
            },

            // Exportación
            exportData(format) {
                const selectedData = this.selectedRows.length > 0 ?
                    this.filteredData.filter(row => this.selectedRows.includes(row.id)) :
                    this.filteredData;

                // Aquí implementarías la lógica de exportación según el formato
                console.log(`Exportando ${selectedData.length} registros en formato ${format}`);

                // Ejemplo de implementación para CSV
                if (format === 'csv') {
                    this.downloadCSV(selectedData);
                }
            },

            downloadCSV(data) {
                const columns = @json($columns);
                const headers = columns.map(col => col.label || col.key).join(',');
                const rows = data.map(row =>
                    columns.map(col => row[col.key] || '').join(',')
                ).join('\n');

                const csv = headers + '\n' + rows;
                const blob = new Blob([csv], {
                    type: 'text/csv'
                });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'datos.csv';
                a.click();
                window.URL.revokeObjectURL(url);
            },

            // Mostrar/ocultar filtros
            toggleFilters() {
                this.showFilters = !this.showFilters;
            },

            // Formateo de datos
            formatDate(dateString) {
                if (!dateString) return '';
                return new Date(dateString).toLocaleDateString('es-ES');
            },

            formatCurrency(amount) {
                if (!amount) return '';
                return new Intl.NumberFormat('es-CO', {
                    style: 'currency',
                    currency: 'COP'
                }).format(amount);
            }
        }
    }
</script>

<style>
    /* Estilos adicionales para la tabla */
    .table-container {
        @apply shadow-neumorph bg-white rounded-xl;
    }

    .table-header {
        @apply bg-gradient-to-r from-sena-verde/10 to-sena-verde/5;
    }

    .table-row:hover {
        @apply bg-sena-verde/5 transition-colors duration-200;
    }

    .form-checkbox:checked {
        @apply bg-sena-verde border-sena-verde;
    }

    .form-checkbox:focus {
        @apply ring-sena-verde ring-offset-2;
    }

    /* Animaciones suaves */
    .transition-all {
        transition: all 0.3s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table-container {
            @apply text-sm;
        }

        .px-6 {
            @apply px-3;
        }

        .py-4 {
            @apply py-2;
        }
    }
</style>

{{--
    Componente de Botones de Exportación - SGPTI SENA
    Ubicación: resources/views/components/data-grid/table-export.blade.php
    Propósito: Botones de exportación con diseño neumorphism light institucional
--}}

@props([
    'title' => 'Exportar datos',
    'formats' => ['excel', 'pdf', 'csv'], // Formatos disponibles
    'route' => null, // Ruta base para exportación
    'data' => null, // Datos para exportar (opcional)
    'filename' => 'exportacion', // Nombre base del archivo
    'filters' => [], // Filtros aplicados
    'columns' => [], // Columnas seleccionadas
    'showDropdown' => true, // Mostrar como dropdown o botones separados
    'size' => 'md', // sm, md, lg
    'position' => 'right', // left, center, right
    'disabled' => false,
    'loading' => false,
    'permissions' => [] // Permisos requeridos por formato
])

@php
    $buttonSizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base'
    ];

    $positions = [
        'left' => 'justify-start',
        'center' => 'justify-center',
        'right' => 'justify-end'
    ];

    $formatConfig = [
        'excel' => [
            'icon' => 'document-chart-bar',
            'label' => 'Excel',
            'color' => 'sena-verde',
            'extension' => 'xlsx',
            'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ],
        'pdf' => [
            'icon' => 'document-text',
            'label' => 'PDF',
            'color' => 'red-500',
            'extension' => 'pdf',
            'mime' => 'application/pdf'
        ],
        'csv' => [
            'icon' => 'table-cells',
            'label' => 'CSV',
            'color' => 'sena-azul',
            'extension' => 'csv',
            'mime' => 'text/csv'
        ]
    ];
@endphp

<div class="flex {{ $positions[$position] }} items-center gap-3"
     role="toolbar"
     aria-label="Herramientas de exportación">

    @if($title)
        <span class="hidden text-sm font-medium text-sena-gris-700 sm:block">
            {{ $title }}
        </span>
    @endif

    @if($showDropdown)
        {{-- Dropdown de exportación --}}
        <div class="relative" x-data="{ open: false }">
            <button
                @click="open = !open"
                @click.outside="open = false"
                type="button"
                class="inline-flex items-center gap-2 {{ $buttonSizes[$size] }}
                       bg-white text-sena-gris-700 font-medium rounded-xl
                       shadow-neumorph hover:shadow-neumorph-hover
                       border border-sena-gris-200 transition-all duration-200
                       focus:outline-none focus:ring-2 focus:ring-sena-verde/50 focus:border-sena-verde
                       disabled:opacity-50 disabled:cursor-not-allowed
                       {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
                {{ $disabled ? 'disabled' : '' }}
                aria-haspopup="true"
                aria-expanded="false"
                :aria-expanded="open"
                aria-label="Menú de exportación">

                @if($loading)
                    <div class="w-4 h-4 border-2 rounded-full animate-spin border-sena-verde border-t-transparent"></div>
                @else
                    <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
                @endif

                <span class="hidden sm:inline">Exportar</span>
                <x-heroicon-o-chevron-down class="w-3 h-3 transition-transform duration-200"
                                          :class="{ 'rotate-180': open }" />
            </button>

            {{-- Dropdown Menu --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute {{ $position === 'left' ? 'left-0' : 'right-0' }} mt-2 w-48
                        bg-white rounded-xl shadow-lg border border-sena-gris-200
                        shadow-neumorph z-50"
                 role="menu"
                 aria-orientation="vertical">

                <div class="py-1">
                    @foreach($formats as $format)
                        @php $config = $formatConfig[$format] ?? null; @endphp

                        @if($config && (empty($permissions[$format]) || auth()->user()->can($permissions[$format])))
                            <button
                                type="button"
                                onclick="exportData('{{ $format }}')"
                                class="flex items-center w-full gap-3 px-4 py-2 text-sm transition-colors duration-150 text-sena-gris-700 hover:bg-sena-gris-50 focus:outline-none focus:bg-sena-gris-50"
                                role="menuitem"
                                aria-label="Exportar en formato {{ $config['label'] }}">

                                <x-dynamic-component
                                    :component="'heroicon-o-' . $config['icon']"
                                    class="h-4 w-4 text-{{ $config['color'] }}" />

                                <span>{{ $config['label'] }}</span>

                                <span class="ml-auto text-xs uppercase text-sena-gris-500">
                                    {{ $config['extension'] }}
                                </span>
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @else
        {{-- Botones separados --}}
        <div class="flex gap-2">
            @foreach($formats as $format)
                @php $config = $formatConfig[$format] ?? null; @endphp

                @if($config && (empty($permissions[$format]) || auth()->user()->can($permissions[$format])))
                    <button
                        type="button"
                        onclick="exportData('{{ $format }}')"
                        class="inline-flex items-center gap-2 {{ $buttonSizes[$size] }}
                               bg-white text-sena-gris-700 font-medium rounded-xl
                               shadow-neumorph hover:shadow-neumorph-hover
                               border border-sena-gris-200 transition-all duration-200
                               focus:outline-none focus:ring-2 focus:ring-sena-verde/50 focus:border-sena-verde
                               disabled:opacity-50 disabled:cursor-not-allowed
                               {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $disabled ? 'disabled' : '' }}
                        aria-label="Exportar en formato {{ $config['label'] }}">

                        <x-dynamic-component
                            :component="'heroicon-o-' . $config['icon']"
                            class="h-4 w-4 text-{{ $config['color'] }}" />

                        <span class="hidden sm:inline">{{ $config['label'] }}</span>
                    </button>
                @endif
            @endforeach
        </div>
    @endif
</div>

{{-- Loading Overlay --}}
<div x-show="$store.export.loading"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
     style="display: none;">

    <div class="max-w-sm p-6 mx-4 bg-white rounded-xl shadow-neumorph">
        <div class="flex items-center gap-3">
            <div class="w-6 h-6 border-2 rounded-full animate-spin border-sena-verde border-t-transparent"></div>
            <div>
                <p class="font-medium text-sena-gris-900">Exportando datos...</p>
                <p class="text-sm text-sena-gris-600">Por favor espere un momento</p>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript para funcionalidad --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('export', {
        loading: false,

        setLoading(value) {
            this.loading = value;
        }
    });
});

function exportData(format) {
    const store = Alpine.store('export');

    if (store.loading) return;

    store.setLoading(true);

    const params = new URLSearchParams({
        format: format,
        filename: '{{ $filename }}',
        filters: JSON.stringify(@json($filters)),
        columns: JSON.stringify(@json($columns)),
        timestamp: new Date().toISOString()
    });

    @if($route)
        const url = `{{ $route }}?${params.toString()}`;

        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la exportación');
            }
            return response.blob();
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `{{ $filename }}_${new Date().toISOString().slice(0,10)}.${format}`;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al exportar los datos. Por favor, intente nuevamente.');
        })
        .finally(() => {
            store.setLoading(false);
        });
    @else
        // Funcionalidad alternativa si no hay ruta
        console.log('Exportando en formato:', format);
        setTimeout(() => {
            store.setLoading(false);
        }, 2000);
    @endif
}
</script>

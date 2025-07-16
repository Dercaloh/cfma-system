<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-slate-800">Prueba de Componentes</h2>
    </x-slot>

    <div class="p-6 space-y-12 bg-white rounded-lg shadow">

        {{-- FILE UPLOAD --}}
        <section>
            <h3 class="text-lg font-semibold text-sena-azul">File Upload</h3>
            <x-file-upload.file-uploader />
            <x-file-upload.file-preview />
            <x-file-upload.file-progress />
        </section>

        {{-- DATE PICKER --}}
        <section>
            <h3 class="text-lg font-semibold text-sena-azul">Date Picker</h3>
            <x-date-picker.date-selector />
            {{-- Asegúrate de que este componente exista --}}
            {{-- <x-date-picker.date-range-picker /> --}}
            <x-date-picker.date-validator />
        </section>

        {{-- QR CODE --}}
        <section>
            <h3 class="text-lg font-semibold text-sena-azul">QR Code</h3>
            <x-qr-code.qr-generator />
            <x-qr-code.qr-scanner />
            <x-qr-code.qr-display />
        </section>

        {{-- DATA GRID: Advanced Table --}}
        <section>
            <h3 class="text-lg font-semibold text-sena-azul">Data Grid</h3>
            <x-data-grid.advanced-table
                :data="collect([
                    ['id' => 1, 'nombre' => 'Portátil HP', 'estado' => 'activo', 'fecha' => '2025-06-01', 'valor' => 2500000],
                    ['id' => 2, 'nombre' => 'Monitor Samsung', 'estado' => 'inactivo', 'fecha' => '2025-04-12', 'valor' => 900000],
                    ['id' => 3, 'nombre' => 'Impresora Canon', 'estado' => 'activo', 'fecha' => '2025-05-10', 'valor' => 1300000],
                ])"
                :columns="[
                    ['key' => 'nombre', 'label' => 'Nombre', 'sortable' => true, 'filterable' => true],
                    ['key' => 'estado', 'label' => 'Estado', 'sortable' => true, 'filterable' => true, 'filter_type' => 'select', 'filter_options' => ['activo' => 'Activo', 'inactivo' => 'Inactivo'], 'type' => 'badge', 'badge_type' => 'status'],
                    ['key' => 'fecha', 'label' => 'Fecha Ingreso', 'sortable' => true, 'filterable' => true, 'filter_type' => 'date', 'type' => 'date'],
                    ['key' => 'valor', 'label' => 'Valor', 'sortable' => true, 'filterable' => false, 'type' => 'currency'],
                ]"
                :paginate="5"
                title="Inventario de Equipos"
                searchable
                filterable
                exportable
                selectable
            >
                <x-slot name="actions">
                    {{-- Botones de acción personalizados para cada fila --}}
                    <x-buttons.secondary-button class="text-xs">Ver</x-buttons.secondary-button>
                    <x-buttons.secondary-button class="text-xs">Editar</x-buttons.secondary-button>
                </x-slot>
                <x-slot name="bulkActions">
                    {{-- Acciones masivas --}}
                    <x-buttons.secondary-button class="text-xs">Exportar Selección</x-buttons.secondary-button>
                </x-slot>
            </x-data-grid.advanced-table>
        </section>

        {{-- INTERACCIÓN --}}
        <section>
            <h3 class="text-lg font-semibold text-sena-azul">Interacción</h3>
            <x-interaction.signature-canvas />
            <x-interaction.tab-navigation />
            <x-interaction.photo-capture />
        </section>

    </div>
</x-app-layout>

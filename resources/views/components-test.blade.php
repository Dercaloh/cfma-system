<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-slate-800">Prueba de Componentes</h2>
    </x-slot>

    <div class="p-6 space-y-8 bg-white rounded-lg shadow">

        <h3 class="text-lg font-semibold">File Upload</h3>
        <x-file-upload.file-uploader />
        <x-file-upload.file-preview />
        <x-file-upload.file-progress />

        <h3 class="text-lg font-semibold">Date Picker</h3>
        <x-date-picker.date-selector />
        <x-date-picker.date-range-picker />
        <x-date-picker.date-validator />

        <h3 class="text-lg font-semibold">QR Code</h3>
        <x-qr-code.qr-generator />
        <x-qr-code.qr-scanner />
        <x-qr-code.qr-display />

        <h3 class="text-lg font-semibold">Data Grid</h3>
        <x-data-grid.advanced-table />
        <x-data-grid.table-filters />
        <x-data-grid.table-export />
        <x-data-grid.table-pagination />

        <h3 class="text-lg font-semibold">Interacción</h3>
        <x-interaction.signature-canvas />
        <x-interaction.tab-navigation />
        <x-interaction.photo-capture />

    </div>
</x-app-layout>

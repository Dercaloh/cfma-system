{{-- resources/views/exit_passes/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">Acta de Salida de Equipos</x-slot>

    <x-glass-container class="text-sm leading-relaxed bg-white text-black shadow-md rounded-xl p-6 space-y-4">
        <h2 class="text-xl font-bold text-center uppercase text-gray-800 border-b pb-2">
            Autorización de Salida de Equipos - CFMA
        </h2>

        <div class="grid grid-cols-2 gap-4">
            <div><strong>Cuentadante:</strong> {{ $exitPass->cuentadante }}</div>
            <div><strong>Cédula:</strong> {{ $exitPass->cedula }}</div>
            <div><strong>Dependencia:</strong> {{ $exitPass->dependencia }}</div>
            <div><strong>Tipo de permiso:</strong> {{ ucfirst($exitPass->permiso) }}</div>
            <div><strong>Autorizado para salida:</strong> {{ $exitPass->autorizado_salida }}</div>
            <div><strong>Autorizado para regreso:</strong> {{ $exitPass->autorizado_regreso ?? '---' }}</div>
        </div>

        <div class="mt-4">
            <strong>Activo relacionado:</strong><br>
            <span>Serial: {{ $exitPass->gateLog->asset->serial_number }}</span><br>
            <span>Tipo: {{ $exitPass->gateLog->asset->type }}</span><br>
            <span>Descripción: {{ $exitPass->gateLog->notes }}</span>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('exit_passes.pdf', $exitPass) }}" target="_blank"
               class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Descargar PDF
            </a>
        </div>
    </x-glass-container>
</x-app-layout>

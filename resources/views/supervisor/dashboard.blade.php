<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">
            Panel del Supervisor
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <p class="text-gray-700">Bienvenido, {{ auth()->user()->name }}.</p>
            <p class="text-gray-500">Desde aquí puedes supervisar los préstamos activos y generar reportes del sistema.</p>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">
            Panel de Portería
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <p class="text-gray-700">Bienvenido, {{ auth()->user()->name }}.</p>
            <p class="text-gray-500">Aquí puedes registrar entregas y devoluciones de activos con validación de estado.</p>
        </div>
    </div>
</x-app-layout>

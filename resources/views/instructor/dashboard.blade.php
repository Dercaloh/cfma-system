{{-- resources/views/instructor/dashboard.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">
            Panel del Instructor
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="text-gray-700">Bienvenido, {{ auth()->user()->name }}.</p>
            <p class="text-gray-500">Aquí puedes gestionar solicitudes de préstamo.</p>
        </div>
    </div>
</x-app-layout>

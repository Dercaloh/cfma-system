{{-- resources/views/errors/403.blade.php --}}
<x-app-layout :header="__('Acceso Denegado')">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow text-center">
        <h1 class="text-3xl font-bold text-red-600 mb-4">403</h1>
        <p class="text-gray-700 mb-6">
            No tienes permisos para acceder a esta sección.
        </p>
        <a href="{{ route('dashboard') }}" class="btn-sena">Volver al inicio</a>
    </div>
</x-app-layout>


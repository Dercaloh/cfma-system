{{-- resources/views/inventario/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">Detalle del activo</h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <p><strong>Serial:</strong> {{ $asset->serial_number }}</p>
            <p><strong>Tipo:</strong> {{ $asset->type }}</p>
            <p><strong>Marca:</strong> {{ $asset->brand }}</p>
            <p><strong>Modelo:</strong> {{ $asset->model }}</p>
            <p><strong>Estado:</strong> {{ $asset->status }}</p>
            <p><strong>Descripción:</strong> {{ $asset->description }}</p>
        </div>
    </div>

    <a href="{{ route('inventario.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
</x-app-layout>

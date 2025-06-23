{{-- resources/views/inventario/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">Editar Activo</h2>
    </x-slot>

    <form method="POST" action="{{ route('inventario.update', $asset) }}" class="bg-white shadow p-6 rounded max-w-xl mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="serial_number" class="block font-semibold text-sm">Serial</label>
            <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number', $asset->serial_number) }}" required
                class="w-full mt-1 border-gray-300 rounded shadow-sm">
        </div>

        <div class="mb-4">
            <label for="type" class="block font-semibold text-sm">Tipo</label>
            <select id="type" name="type" class="w-full mt-1 border-gray-300 rounded shadow-sm" required>
                @foreach(['Portátil', 'Proyector', 'Router', 'Switch', 'Impresora', 'Otro'] as $tipo)
                    <option value="{{ $tipo }}" @selected($asset->type === $tipo)>{{ $tipo }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="brand" class="block font-semibold text-sm">Marca</label>
            <input type="text" id="brand" name="brand" value="{{ old('brand', $asset->brand) }}"
                class="w-full mt-1 border-gray-300 rounded shadow-sm">
        </div>

        <div class="mb-4">
            <label for="status" class="block font-semibold text-sm">Estado</label>
            <select id="status" name="status" class="w-full mt-1 border-gray-300 rounded shadow-sm" required>
                @foreach(['Disponible', 'Prestado', 'En mantenimiento', 'Retirado'] as $estado)
                    <option value="{{ $estado }}" @selected($asset->status === $estado)>{{ $estado }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('inventario.index') }}" class="mr-3 text-gray-600 hover:underline">Cancelar</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar cambios</button>
        </div>
    </form>
</x-app-layout>

{{-- resources/views/inventario/index.blade.php --}}
@extends('layouts.default')

@section('title', 'Inventario de Activos')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Inventario de Activos</h2>
        <a href="{{ route('inventario.create') }}" class="btn-sena">+ Nuevo Activo</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100 text-left text-gray-600">
                <tr>
                    <th class="px-4 py-2">Serial</th>
                    <th class="px-4 py-2">Tipo</th>
                    <th class="px-4 py-2">Marca</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assets as $asset)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $asset->serial_number }}</td>
                        <td class="px-4 py-2">{{ $asset->type }}</td>
                        <td class="px-4 py-2">{{ $asset->brand }}</td>
                        <td class="px-4 py-2">{{ $asset->status }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('inventario.show', $asset) }}" class="text-blue-600 hover:underline">Ver</a>
                            <a href="{{ route('inventario.edit', $asset) }}" class="text-yellow-600 hover:underline">Editar</a>
                            <form method="POST" action="{{ route('inventario.destroy', $asset) }}" onsubmit="return confirm('¿Eliminar este activo?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4">No hay activos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $assets->links() }}
    </div>
@endsection

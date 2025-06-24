{{-- resources/views/inventario/index.blade.php --}}
@extends('layouts.default')

@section('title', 'Inventario de Activos')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Inventario de Activos</h2>
        <a href="{{ route('inventario.create') }}"
           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow-sm text-sm transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>
            Nuevo Activo
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg">
            <thead class="bg-gray-100 text-left text-sm text-gray-600 uppercase">
                <tr>
                    <th class="px-4 py-2">Serial</th>
                    <th class="px-4 py-2">Tipo</th>
                    <th class="px-4 py-2">Marca</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                @forelse ($assets as $asset)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 font-mono text-gray-900">{{ $asset->serial_number }}</td>
                        <td class="px-4 py-2">{{ $asset->type }}</td>
                        <td class="px-4 py-2">{{ $asset->brand ?? '—' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs font-medium
                                @class([
                                    'bg-green-100 text-green-800' => $asset->status === 'Disponible',
                                    'bg-yellow-100 text-yellow-800' => $asset->status === 'Prestado',
                                    'bg-blue-100 text-blue-800' => $asset->status === 'En mantenimiento',
                                    'bg-gray-200 text-gray-800' => $asset->status === 'Retirado',
                                ])">
                                {{ $asset->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('inventario.show', $asset) }}"
                                   class="text-blue-600 hover:text-blue-800 transition" title="Ver">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>

                                <a href="{{ route('inventario.edit', $asset) }}"
                                   class="text-yellow-600 hover:text-yellow-800 transition" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>

                                <form method="POST" action="{{ route('inventario.destroy', $asset) }}"
                                      onsubmit="return confirm('¿Eliminar este activo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition"
                                            title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-6">No hay activos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $assets->links() }}
    </div>
@endsection

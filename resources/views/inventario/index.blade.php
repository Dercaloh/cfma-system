<!-- resources/views/inventario/index.blade.php -->
@extends('layouts.default')

@section('title', 'Inventario de Activos')

@section('content')
<div class="space-y-6">
    <!-- Encabezado -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-sena-azul">Inventario de Activos</h2>
        <a href="{{ route('inventario.create') }}" class="btn-sena inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Nuevo
        </a>
    </div>

    <!-- Feedback de éxito -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded-md text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtros -->
        <h3 class="text-lg font-semibold text-sena-azul">Filtros rápidos</h3>
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm bg-white/40 backdrop-blur-md shadow-md rounded-lg p-4 border border-sena-verde">
        <!-- Estado -->
        <div>
            <label for="status" class="block font-medium text-gray-700">Estado</label>
            <select name="status" id="status" onchange="this.form.submit()" class="form-select-sena">
                <option value="">Todos</option>
                @foreach(['Disponible', 'Prestado', 'En mantenimiento', 'Retirado'] as $estado)
                    <option value="{{ $estado }}" @selected(request('status') === $estado)>{{ $estado }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tipo -->
        <div>
            <label for="type" class="block font-medium text-gray-700">Tipo</label>
            <select name="type" id="type" onchange="this.form.submit()" class="form-select-sena">
                <option value="">Todos</option>
                @foreach(['Portátil', 'Proyector', 'Router', 'Switch', 'Impresora', 'Otro'] as $tipo)
                    <option value="{{ $tipo }}" @selected(request('type') === $tipo)>{{ $tipo }}</option>
                @endforeach
            </select>
        </div>

        <!-- Mostrar eliminados -->
        <div class="flex items-end">
            <label class="inline-flex items-center space-x-2 text-gray-700">
                <input type="checkbox" name="conEliminados" value="1" onchange="this.form.submit()" @checked(request('conEliminados'))
                    class="rounded border-gray-300 text-sena-verde focus:ring-sena-verde">
                <span>Mostrar eliminados</span>
            </label>
        </div>

        <!-- Limpiar -->
        <div class="flex items-end justify-end">
            <a href="{{ route('inventario.index') }}" class="btn-sena bg-red-100 text-red-600 hover:bg-red-200">
                Limpiar filtros
            </a>
        </div>
    </form>

    <!-- Tabla -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow-md text-sm">
            <thead class="bg-gray-50 text-left text-gray-500">
                <tr>
                    <th class="px-4 py-2">Serial</th>
                    <th class="px-4 py-2">Tipo</th>
                    <th class="px-4 py-2">Marca</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2 text-center">Acciones</th>
                    <th class="px-4 py-2 text-center">Registro</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-800">
                @forelse ($assets as $asset)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 font-mono">{{ $asset->serial_number }}</td>
                        <td class="px-4 py-2">{{ $asset->type }}</td>
                        <td class="px-4 py-2">{{ $asset->brand ?? '—' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
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
                                <a href="{{ route('inventario.show', $asset) }}" title="Ver" class="text-blue-600 hover:text-blue-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('inventario.edit', $asset) }}" title="Editar" class="text-yellow-600 hover:text-yellow-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>
                                @if ($asset->trashed())
                                    <form method="POST" action="{{ route('inventario.restore', $asset->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button title="Restaurar" class="text-green-600 hover:text-green-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h4v4H3m0 0a9 9 0 0018 0m-9 9v-3" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('inventario.confirmDelete', $asset) }}"
                                        title="Eliminar"
                                        class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </a>

                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-2 text-center">
                            @if ($asset->trashed())
                                <span class="text-red-600 font-semibold text-xs">Eliminado</span>
                            @else
                                <span class="text-green-600 font-medium text-xs">Activo</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 py-8 italic">
                            @if(request('conEliminados'))
                                No hay activos (ni eliminados) registrados en el sistema.
                            @else
                                No hay activos disponibles. Puedes activar "Mostrar eliminados" para revisar registros anteriores.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div>
        {{ $assets->links() }}
    </div>
</div>
@endsection

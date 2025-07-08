<!-- resources/views/inventario/create.blade.php -->
@extends('layouts.default')

@section('title', 'Registrar Nuevo Activo')
@if (session('info'))
    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-3 rounded-md text-sm">
        {{ session('info') }}
    </div>
@endif

@section('content')
<div class="max-w-3xl mx-auto bg-white/60 backdrop-blur rounded-xl p-8 shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-sena-azul">Registrar Nuevo Activo</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventario.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="serial_number" class="block text-sm font-medium">Serial *</label>
                <input id="serial_number" name="serial_number" type="text" required
                       class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-sena-verde">
            </div>

            <div>
                <label for="placa" class="block text-sm font-medium">Placa (si aplica)</label>
                <input id="placa" name="placa" type="text"
                       class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="ownership" class="block text-sm font-medium">Propiedad *</label>
                <select id="ownership" name="ownership" required
                        class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                    @foreach(['Centro', 'Personal'] as $prop)
                        <option value="{{ $prop }}" @selected(old('ownership') === $prop)>{{ $prop }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="type" class="block text-sm font-medium">Tipo *</label>
                <select id="type" name="type" required
                        class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                    <option value="">Selecciona un tipo</option>
                    @foreach(['Portátil', 'Proyector', 'Router', 'Switch', 'Impresora', 'Otro'] as $tipo)
                        <option value="{{ $tipo }}" @selected(old('type') === $tipo)>{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="brand" class="block text-sm font-medium">Marca</label>
                <input id="brand" name="brand" type="text"
                       class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
            </div>

            <div>
                <label for="model" class="block text-sm font-medium">Modelo</label>
                <input id="model" name="model" type="text"
                       class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="status" class="block text-sm font-medium">Estado lógico *</label>
                <select id="status" name="status" required
                        class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                    @foreach(['Disponible', 'Prestado', 'En mantenimiento', 'Retirado'] as $estado)
                        <option value="{{ $estado }}" @selected(old('status') === $estado)>{{ $estado }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="condition" class="block text-sm font-medium">Condición técnica *</label>
                <select id="condition" name="condition" required
                        class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                    @foreach(['Bueno', 'Regular', 'Dañado', 'En diagnóstico'] as $cond)
                        <option value="{{ $cond }}" @selected(old('condition') === $cond)>{{ $cond }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label for="location" class="block text-sm font-medium">Ubicación *</label>
            <select id="location" name="location" required
                    class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                @foreach(['Almacén', 'Con usuario'] as $loc)
                    <option value="{{ $loc }}" @selected(old('location') === $loc)>{{ $loc }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="assigned_to" class="block text-sm font-medium">Asignado a (opcional)</label>
            <select name="assigned_to" id="assigned_to"
                    class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                <option value="">Sin asignar</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @selected(old('assigned_to') == $user->id)>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center space-x-6">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="loanable" value="1" class="accent-sena-verde" @checked(old('loanable', true))>
                <span class="text-sm">Disponible para préstamo</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="movable" value="1" class="accent-sena-verde" @checked(old('movable', false))>
                <span class="text-sm">Puede salir del centro</span>
            </label>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium">Descripción</label>
            <textarea id="description" name="description" rows="3"
                      class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">{{ old('description') }}</textarea>
        </div>

        <div class="pt-4 flex justify-end gap-4">
            <a href="{{ route('inventario.index') }}"
               class="text-sm px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded text-gray-700">Cancelar</a>
            <button type="submit"
                    class="text-sm bg-sena-verde hover:bg-sena-verde-sec text-white font-semibold px-5 py-2 rounded">
                Guardar Activo
            </button>
        </div>
    </form>
</div>
@endsection

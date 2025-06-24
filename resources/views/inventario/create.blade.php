@extends('layouts.default')

@section('title', 'Registrar Nuevo Activo')

@section('content')
<h2 class="text-2xl font-bold mb-6">Registrar Nuevo Activo</h2>

@if ($errors->any())
    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('inventario.store') }}" method="POST" class="space-y-6 max-w-2xl mx-auto bg-white shadow p-6 rounded">
    @csrf

    {{-- Serial --}}
    <div>
        <label for="serial_number" class="block font-semibold">Serial *</label>
        <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number') }}"
            class="w-full border border-gray-300 rounded px-3 py-2" required>
    </div>

    {{-- Placa (si aplica) --}}
    <div>
        <label for="placa" class="block font-semibold">Placa (si aplica)</label>
        <input type="text" id="placa" name="placa" value="{{ old('placa') }}"
            class="w-full border border-gray-300 rounded px-3 py-2">
    </div>

    {{-- Propiedad --}}
    <div>
        <label for="ownership" class="block font-semibold">Propiedad *</label>
        <select id="ownership" name="ownership" class="w-full border border-gray-300 rounded px-3 py-2" required>
            @foreach(['Centro', 'Personal'] as $prop)
                <option value="{{ $prop }}" @selected(old('ownership') === $prop)>{{ $prop }}</option>
            @endforeach
        </select>
    </div>

    {{-- Tipo --}}
    <div>
        <label for="type" class="block font-semibold">Tipo *</label>
        <select id="type" name="type" class="w-full border border-gray-300 rounded px-3 py-2" required>
            <option value="">Selecciona un tipo</option>
            @foreach(['Portátil', 'Proyector', 'Router', 'Switch', 'Impresora', 'Otro'] as $tipo)
                <option value="{{ $tipo }}" @selected(old('type') === $tipo)>{{ $tipo }}</option>
            @endforeach
        </select>
    </div>

    {{-- Marca y Modelo --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="brand" class="block font-semibold">Marca</label>
            <input type="text" id="brand" name="brand" value="{{ old('brand') }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>
        <div>
            <label for="model" class="block font-semibold">Modelo</label>
            <input type="text" id="model" name="model" value="{{ old('model') }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>
    </div>

    {{-- Estado lógico y técnico --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="status" class="block font-semibold">Estado lógico *</label>
            <select id="status" name="status" class="w-full border border-gray-300 rounded px-3 py-2" required>
                @foreach(['Disponible', 'Prestado', 'En mantenimiento', 'Retirado'] as $estado)
                    <option value="{{ $estado }}" @selected(old('status') === $estado)>{{ $estado }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="condition" class="block font-semibold">Condición técnica *</label>
            <select id="condition" name="condition" class="w-full border border-gray-300 rounded px-3 py-2" required>
                @foreach(['Bueno', 'Regular', 'Dañado', 'En diagnóstico'] as $cond)
                    <option value="{{ $cond }}" @selected(old('condition') === $cond)>{{ $cond }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Ubicación --}}
    <div>
        <label for="location" class="block font-semibold">Ubicación *</label>
        <select id="location" name="location" class="w-full border border-gray-300 rounded px-3 py-2" required>
            @foreach(['Almacén', 'Con usuario'] as $loc)
                <option value="{{ $loc }}" @selected(old('location') === $loc)>{{ $loc }}</option>
            @endforeach
        </select>
    </div>

    {{-- Asignado a --}}
    <div>
        <label for="assigned_to" class="block font-semibold">Asignado a (opcional)</label>
        <select name="assigned_to" id="assigned_to" class="w-full border border-gray-300 rounded px-3 py-2">
            <option value="">Sin asignar</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('assigned_to') == $user->id)>
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
    </div>

    {{-- Permisos --}}
    <div class="flex items-center gap-6">
        <label class="inline-flex items-center">
            <input type="checkbox" name="loanable" value="1" class="rounded border-gray-300"
                @checked(old('loanable', true))>
            <span class="ml-2 text-sm">Disponible para préstamo</span>
        </label>

        <label class="inline-flex items-center">
            <input type="checkbox" name="movable" value="1" class="rounded border-gray-300"
                @checked(old('movable', false))>
            <span class="ml-2 text-sm">Puede salir del centro</span>
        </label>
    </div>

    {{-- Descripción --}}
    <div>
        <label for="description" class="block font-semibold">Descripción</label>
        <textarea id="description" name="description" rows="3"
            class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description') }}</textarea>
    </div>

    {{-- Acciones --}}
    <div class="pt-4 flex items-center gap-4">
        <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
            Guardar Activo
        </button>
        <a href="{{ route('inventario.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
    </div>
</form>
@endsection

{{-- resources/views/inventario/create.blade.php --}}
@extends('layouts.default')

@section('title', 'Registrar Nuevo Activo')

@section('content')
<h2 class="text-2xl font-bold mb-6">Registrar Nuevo Activo</h2>

@if ($errors->any())
    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('inventario.store') }}" method="POST" class="space-y-6">
    @csrf

    <div>
        <label for="serial_number" class="block font-semibold">Serial *</label>
        <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number') }}"
               class="w-full border border-gray-300 rounded px-3 py-2" required>
    </div>

    <div>
        <label for="type" class="block font-semibold">Tipo *</label>
        <select id="type" name="type" class="w-full border border-gray-300 rounded px-3 py-2" required>
            <option value="">Selecciona un tipo</option>
            @foreach(['Portátil', 'Proyector', 'Router', 'Switch', 'Impresora', 'Otro'] as $tipo)
                <option value="{{ $tipo }}" @selected(old('type') == $tipo)>{{ $tipo }}</option>
            @endforeach
        </select>
    </div>

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

    <div>
        <label for="status" class="block font-semibold">Estado *</label>
        <select id="status" name="status" class="w-full border border-gray-300 rounded px-3 py-2" required>
            @foreach(['Disponible', 'Prestado', 'En mantenimiento', 'Retirado'] as $estado)
                <option value="{{ $estado }}" @selected(old('status') == $estado)>
                    {{ $estado }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="description" class="block font-semibold">Descripción</label>
        <textarea id="description" name="description" rows="3"
                  class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description') }}</textarea>
    </div>

    <div class="pt-4 flex items-center gap-4">
        <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
            Guardar Activo
        </button>
        <a href="{{ route('inventario.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
    </div>
</form>
@endsection

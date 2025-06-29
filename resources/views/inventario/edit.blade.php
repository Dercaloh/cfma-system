{{-- resources/views/inventario/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">Editar Activo</h2>
    </x-slot>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('inventario.update', $asset) }}"
        class="bg-white shadow p-6 rounded max-w-2xl mx-auto space-y-5">
        @csrf
        @method('PUT')

        {{-- Serial --}}
        <div>
            <label for="serial_number" class="block font-semibold text-sm">Serial *</label>
            <input type="text" name="serial_number" id="serial_number"
                value="{{ old('serial_number', $asset->serial_number) }}"
                required class="w-full mt-1 border-gray-300 rounded shadow-sm">
        </div>

        {{-- Placa (si es del centro) --}}
        <div>
            <label for="placa" class="block font-semibold text-sm">Placa (si aplica)</label>
            <input type="text" name="placa" id="placa"
                value="{{ old('placa', $asset->placa) }}"
                class="w-full mt-1 border-gray-300 rounded shadow-sm">
        </div>

        {{-- Propiedad --}}
        <div>
            <label for="ownership" class="block font-semibold text-sm">Propiedad *</label>
            <select name="ownership" id="ownership" required class="w-full mt-1 border-gray-300 rounded shadow-sm">
                @foreach(['Centro', 'Personal'] as $prop)
                    <option value="{{ $prop }}" @selected(old('ownership', $asset->ownership) === $prop)>
                        {{ $prop }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tipo --}}
        <div>
            <label for="type" class="block font-semibold text-sm">Tipo *</label>
            <select name="type" id="type" required class="w-full mt-1 border-gray-300 rounded shadow-sm">
                @foreach(['Portátil', 'Proyector', 'Router', 'Switch', 'Impresora', 'Otro'] as $tipo)
                    <option value="{{ $tipo }}" @selected(old('type', $asset->type) === $tipo)>
                        {{ $tipo }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Marca y modelo --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="brand" class="block font-semibold text-sm">Marca</label>
                <input type="text" name="brand" id="brand"
                    value="{{ old('brand', $asset->brand) }}"
                    class="w-full mt-1 border-gray-300 rounded shadow-sm">
            </div>
            <div>
                <label for="model" class="block font-semibold text-sm">Modelo</label>
                <input type="text" name="model" id="model"
                    value="{{ old('model', $asset->model) }}"
                    class="w-full mt-1 border-gray-300 rounded shadow-sm">
            </div>
        </div>

        {{-- Estado lógico y técnico --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="status" class="block font-semibold text-sm">Estado lógico *</label>
                <select name="status" id="status" required class="w-full mt-1 border-gray-300 rounded shadow-sm">
                    @foreach(['Disponible', 'Prestado', 'En mantenimiento', 'Retirado'] as $estado)
                        <option value="{{ $estado }}" @selected(old('status', $asset->status) === $estado)>
                            {{ $estado }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="condition" class="block font-semibold text-sm">Condición técnica *</label>
                <select name="condition" id="condition" required class="w-full mt-1 border-gray-300 rounded shadow-sm">
                    @foreach(['Bueno', 'Regular', 'Dañado', 'En diagnóstico'] as $cond)
                        <option value="{{ $cond }}" @selected(old('condition', $asset->condition) === $cond)>
                            {{ $cond }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Ubicación --}}
        <div>
            <label for="location" class="block font-semibold text-sm">Ubicación *</label>
            <select name="location" id="location" required class="w-full mt-1 border-gray-300 rounded shadow-sm">
                @foreach(['Almacén', 'Con usuario'] as $loc)
                    <option value="{{ $loc }}" @selected(old('location', $asset->location) === $loc)>
                        {{ $loc }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Asignado a (opcional) --}}
        <div>
            <label for="assigned_to" class="block font-semibold text-sm">Asignado a (opcional)</label>
            <select name="assigned_to" id="assigned_to" class="w-full mt-1 border-gray-300 rounded shadow-sm">
                <option value="">Sin asignar</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @selected(old('assigned_to', $asset->assigned_to) == $user->id)>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Permite préstamo y salida --}}
    <div class="flex items-center gap-6">
        <label class="inline-flex items-center">
            <input type="hidden" name="loanable" value="0">
            <input type="checkbox" name="loanable" value="1" class="rounded border-gray-300"
                @checked(old('loanable', $asset->loanable))>
            <span class="ml-2 text-sm">Disponible para préstamo</span>
        </label>

        <label class="inline-flex items-center">
            <input type="hidden" name="movable" value="0">
            <input type="checkbox" name="movable" value="1" class="rounded border-gray-300"
                @checked(old('movable', $asset->movable))>
            <span class="ml-2 text-sm">Puede salir del centro</span>
        </label>
    </div>


        {{-- Descripción --}}
        <div>
            <label for="description" class="block font-semibold text-sm">Descripción</label>
            <textarea name="description" id="description" rows="3"
                class="w-full mt-1 border-gray-300 rounded shadow-sm">{{ old('description', $asset->description) }}</textarea>
        </div>

        {{-- Acciones --}}
        <div class="flex justify-end pt-4">
            <a href="{{ route('inventario.index') }}" class="text-gray-600 hover:underline mr-4">Cancelar</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Guardar cambios
            </button>
        </div>
    </form>
</x-app-layout>

{{-- resources/views/inventario/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">Detalle del Activo</h2>
    </x-slot>

    <div class="bg-white shadow-md rounded p-6 max-w-3xl mx-auto space-y-6">

        {{-- Identificación --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <p class="text-sm font-semibold">Serial</p>
                <p class="text-gray-800">{{ $asset->serial_number }}</p>
            </div>
            @if ($asset->ownership === 'Centro')
                <div>
                    <p class="text-sm font-semibold">Placa</p>
                    <p class="text-gray-800">{{ $asset->placa ?? '—' }}</p>
                </div>
            @endif
        </div>

        {{-- Clasificación --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <p class="text-sm font-semibold">Tipo</p>
                <p class="text-gray-800">{{ $asset->type }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold">Marca</p>
                <p class="text-gray-800">{{ $asset->brand ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold">Modelo</p>
                <p class="text-gray-800">{{ $asset->model ?? '—' }}</p>
            </div>
        </div>

        {{-- Estado técnico y lógico --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <p class="text-sm font-semibold">Estado lógico</p>
                <p class="text-gray-800">{{ $asset->status }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold">Condición técnica</p>
                <p class="text-gray-800">{{ $asset->condition }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold">Ubicación</p>
                <p class="text-gray-800">{{ $asset->location }}</p>
            </div>
        </div>

        {{-- Asignación --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <p class="text-sm font-semibold">Asignado a</p>
                <p class="text-gray-800">
                    @if ($asset->cuentadante)
                        {{ $asset->cuentadante->name }} <br>
                        <span class="text-sm text-gray-500">{{ $asset->cuentadante->email }}</span>
                    @else
                        — No asignado —
                    @endif
                </p>
            </div>
            <div>
                <p class="text-sm font-semibold">Propiedad</p>
                <p class="text-gray-800">{{ $asset->ownership }}</p>
            </div>
        </div>

        {{-- Permisos --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <p class="text-sm font-semibold">¿Disponible para préstamo?</p>
                <p class="text-gray-800">
                    {{ $asset->loanable ? 'Sí' : 'No' }}
                </p>
            </div>
            <div>
                <p class="text-sm font-semibold">¿Puede salir del centro?</p>
                <p class="text-gray-800">
                    {{ $asset->movable ? 'Sí' : 'No' }}
                </p>
            </div>
        </div>

        {{-- Descripción --}}
        <div>
            <p class="text-sm font-semibold">Descripción</p>
            <p class="text-gray-800">{{ $asset->description ?? '—' }}</p>
        </div>

        {{-- Acciones --}}
        <div class="flex justify-end pt-4">
            <a href="{{ route('inventario.edit', $asset) }}"
                class="text-sm bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded mr-3">
                Editar
            </a>
            <a href="{{ route('inventario.index') }}"
                class="text-sm bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded text-gray-800">
                Volver
            </a>
        </div>
    </div>
</x-app-layout>

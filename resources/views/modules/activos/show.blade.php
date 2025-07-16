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

        {{-- Documentos Asociados --}}
        @if ($asset->documents->count())
            <div class="mt-8 border-t pt-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">📎 Documentos Asociados</h3>

                <ul class="space-y-3">
                    @foreach ($asset->documents as $doc)
                        <li class="flex justify-between items-center bg-gray-50 p-3 rounded border text-sm">
                            <div>
                                <a href="{{ asset('storage/' . $doc->path) }}" target="_blank" class="text-blue-600 hover:underline">
                                    {{ $doc->filename }}
                                </a>
                                @if ($doc->description)
                                    <p class="text-gray-500">{{ $doc->description }}</p>
                                @endif
                            </div>
                            <span class="text-xs text-gray-400">
                                {{ \Illuminate\Support\Carbon::parse($doc->created_at)->format('d/m/Y') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @can('update', $asset)
    <div class="mt-10 border-t pt-6">
        <h3 class="text-lg font-semibold mb-3">📤 Subir nuevo documento</h3>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('documentos.store', $asset) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="file" class="block text-sm font-semibold">Archivo *</label>
                <input type="file" name="file" required
                    class="block w-full border border-gray-300 rounded px-3 py-2">
                <p class="text-xs text-gray-500 mt-1">
                    Archivos permitidos: PDF, DOCX, XLSX, JPG, PNG (máx. 2MB).
                </p>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold">Descripción</label>
                <input type="text" name="description" maxlength="255"
                    class="block w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                Subir Documento
            </button>
        </form>
    </div>
@endcan


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

{{-- resources/views/inventario/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">Detalle del Activo</h2>
    </x-slot>

    <div x-data="{ tab: 'general' }" class="bg-white shadow-md rounded p-6 max-w-4xl mx-auto">
        {{-- Navegación por pestañas --}}
        <nav class="flex space-x-4 border-b mb-6">
            <button :class="tab === 'general' ? 'border-b-2 border-green-600 text-green-700' : 'text-gray-500'"
                    @click="tab = 'general'"
                    class="px-3 py-2 font-semibold focus:outline-none">
                Información General
            </button>
            <button :class="tab === 'documentos' ? 'border-b-2 border-green-600 text-green-700' : 'text-gray-500'"
                    @click="tab = 'documentos'"
                    class="px-3 py-2 font-semibold focus:outline-none">
                Documentos
            </button>
            <button :class="tab === 'actas' ? 'border-b-2 border-green-600 text-green-700' : 'text-gray-500'"
                    @click="tab = 'actas'"
                    class="px-3 py-2 font-semibold focus:outline-none">
                Actas de Salida
            </button>
        </nav>

        {{-- Contenido según pestaña activa --}}
        <div x-show="tab === 'general'">
            @include('inventario.partials.general')
        </div>

        <div x-show="tab === 'documentos'">
            @include('inventario.partials.documentos')
        </div>

        <div x-show="tab === 'actas'">
            @include('inventario.partials.actas')
        </div>

        {{-- Acciones --}}
        <div class="flex justify-end pt-6">
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

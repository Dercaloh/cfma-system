<!-- confirm_restore.blade.php optimizado UX minimalista -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-slate-800">Recuperar Activo Eliminado</h2>
    </x-slot>
   <!-- Aquí puedes agregar un espacio para el mensaje de éxito o error si es necesario -->
    <div class="bg-white/60 backdrop-blur shadow-md rounded-xl max-w-xl mx-auto mt-10 p-8 space-y-6">
        <p class="text-slate-700 text-sm">
            El serial <strong class="text-slate-900">{{ $asset->serial_number }}</strong>
            @if ($asset->placa)
                y la placa <strong class="text-slate-900">{{ $asset->placa }}</strong>
            @endif
            ya existen en un activo eliminado.
        </p>
        <!-- Mensaje de confirmación -->
        <p class="text-xs text-slate-500">¿Deseas restaurarlo en lugar de registrar uno nuevo?</p>
        <!-- Formulario para restaurar el activo -->
        <form action="{{ route('inventario.restore', $asset->id) }}" method="POST" class="flex justify-end gap-4">
            @csrf
            @method('PATCH')
            <input type="hidden" name="from_create" value="1">

            <a href="{{ route('inventario.create') }}"
               class="px-4 py-2 text-sm rounded bg-slate-200 hover:bg-slate-300 text-slate-700 transition">
                Crear nuevo
            </a>

            <button type="submit"
                    class="px-4 py-2 text-sm rounded bg-emerald-600 hover:bg-emerald-700 text-white transition">
                Restaurar
            </button>
        </form>
    </div>
</x-app-layout>

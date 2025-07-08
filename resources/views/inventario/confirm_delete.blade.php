<!-- confirm_delete.blade.php optimizado UX minimalista -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-slate-800">Confirmar Eliminación</h2>
    </x-slot>
    <!-- Aquí puedes agregar un espacio para el mensaje de éxito o error si es necesario -->
    <div class="bg-white/60 backdrop-blur shadow-md rounded-xl max-w-md mx-auto mt-10 p-8 text-center space-y-6">
        <svg class="w-12 h-12 mx-auto text-red-500" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>

        <h3 class="text-lg font-semibold text-slate-800">
            Eliminar activo <span class="text-emerald-600">{{ $asset->serial_number }}</span>
        </h3>

        <p class="text-xs text-slate-500">
            Esta acción marcará el activo como eliminado lógicamente. Podrás restaurarlo si es necesario.
        </p>
        <!-- Mensaje de confirmación -->
        <form action="{{ route('inventario.deleteConfirm', $asset) }}" method="POST" class="flex gap-4 justify-center">
            @csrf
            @method('DELETE')

            <a href="{{ route('inventario.index') }}"
               class="px-4 py-2 text-sm rounded bg-slate-200 hover:bg-slate-300 text-slate-700 transition">
                Cancelar
            </a>

            <button type="submit"
                    class="px-4 py-2 text-sm rounded bg-red-500 hover:bg-red-600 text-white transition">
                Eliminar
            </button>
        </form>
    </div>
</x-app-layout>

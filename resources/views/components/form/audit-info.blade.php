{{-- resources/views/components/form/audit-info.blade.php --}}
@props([
    'createdAt',
    'updatedAt',
])

<section class="pt-6 border-t border-gray-200">
    <h3 class="mb-4 text-sm font-semibold tracking-wide text-gray-800 uppercase">
        Información de auditoría
    </h3>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        {{-- Creado --}}
        <div class="p-4 shadow-sm bg-gray-50 rounded-xl">
            <p class="text-xs font-medium text-gray-500 uppercase">Creado</p>
            <p class="text-sm text-gray-900">{{ $createdAt->format('d/m/Y H:i:s') }}</p>
            <p class="text-xs text-gray-500">{{ $createdAt->diffForHumans() }}</p>
        </div>

        {{-- Actualizado --}}
        <div class="p-4 shadow-sm bg-gray-50 rounded-xl">
            <p class="text-xs font-medium text-gray-500 uppercase">Última modificación</p>
            <p class="text-sm text-gray-900">{{ $updatedAt->format('d/m/Y H:i:s') }}</p>
            <p class="text-xs text-gray-500">{{ $updatedAt->diffForHumans() }}</p>
        </div>
    </div>
</section>

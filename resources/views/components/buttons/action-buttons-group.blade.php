{{-- resources/views/components/buttons/action-buttons-group.blade.php --}}
@props([
    'assetType',
    'showRoute' => 'admin.tipos_activos.show',
    'editRoute' => 'admin.tipos_activos.edit',
    'deleteRoute' => 'admin.tipos_activos.destroy',
])

<div class="flex items-center justify-center gap-2">
    {{-- Ver detalles --}}
    <a href="{{ route($showRoute, $assetType) }}"
       class="text-blue-600 hover:text-blue-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500 action-button"
       title="Ver detalles"
       aria-label="Ver detalles de {{ $assetType->name }}">
        <x-heroicon-o-eye class="w-5 h-5" />
    </a>

    @can('gestionar tipos de activos')
        {{-- Editar --}}
        <a href="{{ route($editRoute, $assetType) }}"
           class="text-yellow-600 hover:text-yellow-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-yellow-500 action-button"
           title="Editar"
           aria-label="Editar {{ $assetType->name }}">
            <x-heroicon-o-pencil-square class="w-5 h-5" />
        </a>

        {{-- Eliminar --}}
        <x-buttons.delete-confirmation-button
            :route="route($deleteRoute, $assetType)"
            :item-name="$assetType->name"
            confirm-message="¿Estás seguro de que deseas eliminar el tipo de activo &quot;{{ $assetType->name }}&quot;? Esta acción no se puede deshacer."
        />
    @endcan
</div>

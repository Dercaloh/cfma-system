{{-- resources/views/components/buttons/table-row-actions.blade.php --}}
@props([
    'item', // Requiere el modelo o recurso (ej: $assetType, $user, etc.)
    'showRoute',
    'editRoute' => null,
    'deleteRoute' => null,
    'canEdit' => true,
    'canDelete' => true,
])

<div class="flex items-center justify-center gap-2">
    {{-- Ver detalles --}}
    <a href="{{ route($showRoute, $item) }}"
       class="text-blue-600 hover:text-blue-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500 action-button"
       title="Ver detalles"
       aria-label="Ver detalles de {{ $item->name ?? $item->id }}">
        <x-heroicon-o-eye class="w-5 h-5" />
    </a>

    {{-- Editar --}}
    @if($editRoute && $canEdit)
        <a href="{{ route($editRoute, $item) }}"
           class="text-yellow-600 hover:text-yellow-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-yellow-500 action-button"
           title="Editar"
           aria-label="Editar {{ $item->name ?? $item->id }}">
            <x-heroicon-o-pencil-square class="w-5 h-5" />
        </a>
    @endif

    {{-- Eliminar --}}
    @if($deleteRoute && $canDelete)
        <x-buttons.delete-confirmation-button
            :route="route($deleteRoute, $item)"
            :item-name="$item->name ?? $item->id"
            confirm-message="¿Estás seguro de que deseas eliminar &quot;{{ $item->name ?? $item->id }}&quot;? Esta acción no se puede deshacer."
        />
    @endif
</div>

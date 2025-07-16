@props([
    'item',
    'showRoute',
    'editRoute' => null,
    'deleteRoute' => null,
    'restoreRoute' => null,
    'forceDeleteRoute' => null,
])

@php
    $isDeleted = method_exists($item, 'trashed') && $item->trashed();
@endphp

<div class="flex items-center justify-end gap-2 action-buttons">
    {{-- Ver --}}
    <a href="{{ route($showRoute, $item->id) }}"
       class="rounded text-sena-azul hover:text-sena-azul/80 focus:outline-none focus:ring-2 focus:ring-sena-azul"
       title="Ver"
       aria-label="Ver detalles">
        <x-heroicon-o-eye class="w-5 h-5" />
    </a>

    {{-- Editar (solo si no está eliminado) --}}
    @if (!$isDeleted && $editRoute)
        <a href="{{ route($editRoute, $item->id) }}"
           class="rounded text-sena-verde hover:text-sena-verde/80 focus:outline-none focus:ring-2 focus:ring-sena-verde"
           title="Editar"
           aria-label="Editar">
            <x-heroicon-o-pencil-square class="w-5 h-5" />
        </a>
    @endif

    {{-- Eliminar (soft delete) --}}
    @if (!$isDeleted && $deleteRoute)
        <form method="POST" action="{{ route($deleteRoute, $item->id) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="rounded text-sena-rojo hover:text-sena-rojo/80 focus:outline-none focus:ring-2 focus:ring-sena-rojo"
                    title="Eliminar"
                    aria-label="Eliminar">
                <x-heroicon-o-trash class="w-5 h-5" />
            </button>
        </form>
    @endif

    {{-- Restaurar --}}
    @if ($isDeleted && $restoreRoute)
        <form method="POST" action="{{ route($restoreRoute, $item->id) }}" class="inline">
            @csrf
            <button type="submit"
                    class="rounded text-sena-amarillo hover:text-sena-amarillo/80 focus:outline-none focus:ring-2 focus:ring-sena-amarillo"
                    title="Restaurar"
                    aria-label="Restaurar">
                <x-heroicon-o-arrow-uturn-left class="w-5 h-5" />
            </button>
        </form>
    @endif

    {{-- Eliminación permanente --}}
    @if ($isDeleted && $forceDeleteRoute)
        <form method="POST" action="{{ route($forceDeleteRoute, $item->id) }}" class="inline" onsubmit="return confirm('¿Eliminar permanentemente este registro? Esta acción no se puede deshacer.')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="rounded text-sena-rojo-dark hover:text-sena-rojo-dark/80 focus:outline-none focus:ring-2 focus:ring-sena-rojo-dark"
                    title="Eliminar permanentemente"
                    aria-label="Eliminación permanente">
                <x-heroicon-o-x-circle class="w-5 h-5" />
            </button>
        </form>
    @endif
</div>

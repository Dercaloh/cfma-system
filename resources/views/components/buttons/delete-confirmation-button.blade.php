{{-- resources/views/components/buttons/delete-confirmation-button.blade.php --}}
@props([
    'route',
    'itemName' => 'este elemento',
    'confirmMessage' => null
])

@php
    $message = $confirmMessage ?? "¿Estás seguro de que deseas eliminar el tipo de activo \"{$itemName}\"?\n\nEsta acción no se puede deshacer.";
@endphp

<form method="POST" action="{{ $route }}" class="inline-block">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="text-red-600 hover:text-red-800 action-button delete-button"
            title="Eliminar"
            data-confirm-message="{{ $message }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
    </button>
</form>

@props([
    'icon' => null,
    'title' => 'Sin resultados',
    'message' => 'No se encontraron registros.',
    'action' => null,
])

<div class="p-12 text-center text-sena-gris-oscuro">
    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 text-blue-600 bg-blue-100 rounded-full">
        {{ $icon }}
    </div>
    <h3 class="mb-2 text-lg font-semibold">{{ $title }}</h3>
    <p class="mb-4 text-sm text-gray-500">{{ $message }}</p>
    @if ($action)
        <div>
            {{ $action }}
        </div>
    @endif
</div>

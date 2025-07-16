@props([
    'sortKey', // Obligatorio: clave usada para ordenar
    'currentSort' => request('sort'), // valor actual en la URL (e.g. 'name')
    'currentDirection' => request('direction', 'asc'), // valor actual (asc o desc)
    'baseUrl' => request()->url(), // ruta actual
    'queryParams' => request()->except(['sort', 'direction']) // otros parámetros que deben persistir
])

@php
    $isActive = $currentSort === $sortKey;
    $nextDirection = $isActive && $currentDirection === 'asc' ? 'desc' : 'asc';

    $sortUrl = $baseUrl . '?' . http_build_query(array_merge($queryParams, [
        'sort' => $sortKey,
        'direction' => $nextDirection
    ]));
@endphp

<a href="{{ $sortUrl }}"
   class="flex items-center gap-1 transition-colors duration-200 hover:text-gray-700">
    {{ $slot }}

    @if ($isActive)
        {{-- Flecha que indica dirección actual --}}
        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="{{ $currentDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"/>
        </svg>
    @else
        {{-- Icono neutral si no está activo --}}
        <svg class="w-4 h-4 text-gray-400 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
        </svg>
    @endif
</a>

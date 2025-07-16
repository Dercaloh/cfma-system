@props([
    'icon' => 'document',
    'color' => 'amber',
    'title',
    'subtitle' => null,
])

@php
    // Mapeo de colores genéricos a clases institucionales
    $colorMap = [
        'amber' => 'from-sena-amarillo to-yellow-400',
        'blue' => 'from-sena-azul to-sena-azul-600',
        'green' => 'from-sena-verde to-sena-verde-sec',
        'red' => 'from-red-500 to-red-600',
        'gray' => 'from-sena-gris-400 to-sena-gris-600',
        'yellow' => 'from-sena-amarillo to-yellow-500',
        'purple' => 'from-sena-azul-violeta to-purple-600',
        'cyan' => 'from-sena-cian to-cyan-400',
    ];

    $gradient = $colorMap[$color] ?? $colorMap['gray'];
@endphp

<div class="border-b shadow-inner bg-white/60 backdrop-blur-md border-sena-verde/20">
    {{-- Este contenedor centra el contenido del header --}}
    <div class="px-6 py-6 mx-auto max-w-7xl">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl shadow-md bg-gradient-to-br {{ $gradient }}">
                    @svg('heroicon-o-' . $icon, 'w-6 h-6 text-white')
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
                    @if ($subtitle)
                        <p class="text-sm text-gray-600">{!! $subtitle !!}</p>
                    @endif
                </div>
            </div>
            @if ($actions ?? false)
                <div class="flex items-center gap-2">
                    {{ $actions }}
                </div>
            @endif
        </div>
    </div>
</div>

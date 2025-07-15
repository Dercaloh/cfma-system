@props([
    'icon' => 'document',
    'color' => 'amber',
    'title',
    'subtitle' => null,
])

@php
    $colorMap = [
        'amber' => 'from-amber-500 to-amber-600',
        'blue' => 'from-blue-500 to-blue-600',
        'green' => 'from-green-500 to-green-600',
        'red' => 'from-red-500 to-red-600',
        'gray' => 'from-gray-500 to-gray-600',
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

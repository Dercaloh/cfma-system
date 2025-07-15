@props([
    'href',
    'text',
    'icon' => null, // Ej: 'arrow-left', 'eye'
    'color' => 'gray', // Otras opciones: 'amber', 'red', 'blue'
])

@php
    $baseClasses = 'inline-flex items-center gap-2 px-4 py-2 text-sm rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2';
    $colorClasses = match($color) {
        'amber' => 'bg-amber-100 text-amber-800 hover:bg-amber-200 focus:ring-amber-500',
        'blue' => 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:ring-blue-500',
        'red' => 'bg-red-100 text-red-800 hover:bg-red-200 focus:ring-red-500',
        default => 'bg-gray-100 text-gray-700 hover:bg-gray-200 focus:ring-gray-500',
    };
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClasses $colorClasses"]) }}>
    @if($icon)
    @svg('heroicon-o-' . $icon, 'w-4 h-4')
@endif

    {{ $text }}
</a>

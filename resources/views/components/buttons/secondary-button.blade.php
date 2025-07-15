{{-- resources/views/components/buttons/secondary-button.blade.php --}}
@props([
    'href' => null,
    'text' => 'Cancelar',
    'icon' => 'x-mark',
    'type' => 'button',
])

@php
    $classes = "inline-flex items-center gap-2 px-4 py-2 text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @svg("heroicon-o-{$icon}", 'w-4 h-4')
        {{ $text }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @svg("heroicon-o-{$icon}", 'w-4 h-4')
        {{ $text }}
    </button>
@endif

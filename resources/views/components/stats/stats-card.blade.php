@props([
    'title',
    'value',
    'color' => 'blue',
    'icon' => 'information-circle'
])

@php
    $colorClasses = [
        'blue' => 'text-blue-600 bg-blue-100',
        'green' => 'text-green-600 bg-green-100',
        'red' => 'text-red-600 bg-red-100',
        'purple' => 'text-purple-600 bg-purple-100',
    ];
@endphp

<div class="flex items-center w-full gap-4 px-4 py-3 transition-all duration-200 bg-white rounded-lg shadow-neumorph hover:shadow-neumorph-hover sm:w-auto">
    <div class="flex items-center justify-center w-10 h-10 rounded-full {{ $colorClasses[$color] }}">
        <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-5 h-5" />
    </div>
    <div class="flex flex-col">
        <span class="text-sm font-medium text-sena-azul/70">{{ $title }}</span>
        <span class="text-lg font-bold text-sena-azul">{{ $value }}</span>
    </div>
</div>

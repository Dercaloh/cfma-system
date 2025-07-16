{{-- resources/views/components/buttons/secondary-button.blade.php --}}
{{--
SGPTI - Sistema de Gestión de Préstamos de TI
Componente: Botón Secundario
Autor: CFMA-SENA
Versión: 1.0
Accesibilidad: WCAG 2.1 AA
--}}
@props([
    'href' => null,
    'text' => null,
    'icon' => null,
    'type' => 'button',
    'size' => 'md',
    'variant' => 'default',
    'disabled' => false,
    'loading' => false,
    'target' => null,
    'ariaLabel' => null
])

@php
    $sizeClasses = [
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
        'xl' => 'px-6 py-3 text-base',
    ];

    $variantClasses = [
        'default' => 'text-gray-700 bg-white border-gray-300 hover:bg-gray-50 focus:ring-gray-500',
        'danger' => 'text-red-700 bg-red-50 border-red-300 hover:bg-red-100 focus:ring-red-500',
        'success' => 'text-green-700 bg-green-50 border-green-300 hover:bg-green-100 focus:ring-green-500',
        'warning' => 'text-yellow-700 bg-yellow-50 border-yellow-300 hover:bg-yellow-100 focus:ring-yellow-500',
        'info' => 'text-blue-700 bg-blue-50 border-blue-300 hover:bg-blue-100 focus:ring-blue-500',
    ];

    $baseClasses = "inline-flex items-center justify-center gap-2 font-medium rounded-lg border transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed";
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $variantClass = $variantClasses[$variant] ?? $variantClasses['default'];

    $classes = "$baseClasses $sizeClass $variantClass";

    $iconSize = match($size) {
        'xs' => 'w-3 h-3',
        'sm' => 'w-4 h-4',
        'md' => 'w-4 h-4',
        'lg' => 'w-5 h-5',
        'xl' => 'w-6 h-6',
        default => 'w-4 h-4'
    };
@endphp

@if ($href)
    <a href="{{ $href }}"
       {{ $attributes->merge(['class' => $classes]) }}
       @if($target) target="{{ $target }}" @endif
       @if($ariaLabel) aria-label="{{ $ariaLabel }}" @endif>

        @if($loading)
            <svg class="{{ $iconSize }} animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @elseif($icon)
            @if(str_starts_with($icon, 'heroicon'))
                <x-dynamic-component :component="$icon" class="{{ $iconSize }}" />
            @else
                <x-heroicon-o-{{ $icon }} class="{{ $iconSize }}" />
            @endif
        @endif

        @if($text)
            {{ $text }}
        @else
            {{ $slot }}
        @endif
    </a>
@else
    <button type="{{ $type }}"
            {{ $attributes->merge(['class' => $classes]) }}
            @if($disabled || $loading) disabled @endif
            @if($ariaLabel) aria-label="{{ $ariaLabel }}" @endif>

        @if($loading)
            <svg class="{{ $iconSize }} animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @elseif($icon)
            @if(str_starts_with($icon, 'heroicon'))
                <x-dynamic-component :component="$icon" class="{{ $iconSize }}" />
            @else
                <x-heroicon-o-{{ $icon }} class="{{ $iconSize }}" />
            @endif
        @endif

        @if($text)
            {{ $text }}
        @else
            {{ $slot }}
        @endif
    </button>
@endif

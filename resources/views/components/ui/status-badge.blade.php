{{-- resources/views/components/ui/status-badge.blade.php --}}
@props([
    'active' => true,
    'size' => 'sm',
])

@php
    $sizeClasses = [
        'xs' => 'px-2 py-0.5 text-xs',
        'sm' => 'px-2.5 py-0.5 text-xs',
        'md' => 'px-3 py-1 text-sm',
        'lg' => 'px-4 py-1.5 text-sm',
    ];

    $baseClass = "inline-flex items-center font-medium rounded-full";
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['sm'];
    $stateClass = $active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
    $icon = $active ? 'heroicon-s-check-circle' : 'heroicon-s-x-circle';
    $label = $active ? 'Activo' : 'Inactivo';
@endphp

<span {{ $attributes->merge(['class' => "$baseClass $sizeClass $stateClass"]) }}>
    <x-dynamic-component :component="$icon" class="w-4 h-4 mr-1" />
    {{ $label }}
</span>

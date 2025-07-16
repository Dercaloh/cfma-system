{{-- resources/views/components/ui/status-badge.blade.php --}}
{{-- SGPTI - Componente reusable de estado con ícono o punto animado --}}
@props([
    'status' => 'active',
    'type' => 'default', // opciones: default | icon | dot
    'size' => 'sm',
    'label' => null,
    'icon' => null,
    'pulse' => false,
    'customColors' => null,
])

@php
    // Convertir string 'false' o 'true' en booleano
    $pulse = filter_var($pulse, FILTER_VALIDATE_BOOLEAN);

    $sizeClasses = [
        'xs' => 'px-2 py-0.5 text-xs',
        'sm' => 'px-2.5 py-0.5 text-xs',
        'md' => 'px-3 py-1 text-sm',
        'lg' => 'px-4 py-1.5 text-sm',
        'xl' => 'px-5 py-2 text-base',
    ];

    $statusConfig = [
        'active' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-800',
            'border' => 'border-green-200',
            'icon' => 'heroicon-s-check-circle',
            'label' => 'Activo',
            'dot' => 'bg-green-500',
        ],
        'inactive' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-800',
            'border' => 'border-red-200',
            'icon' => 'heroicon-s-x-circle',
            'label' => 'Inactivo',
            'dot' => 'bg-red-500',
        ],
        'pending' => [
            'bg' => 'bg-yellow-100',
            'text' => 'text-yellow-800',
            'border' => 'border-yellow-200',
            'icon' => 'heroicon-s-clock',
            'label' => 'Pendiente',
            'dot' => 'bg-yellow-500',
        ],
        'approved' => [
            'bg' => 'bg-blue-100',
            'text' => 'text-blue-800',
            'border' => 'border-blue-200',
            'icon' => 'heroicon-s-check-badge',
            'label' => 'Aprobado',
            'dot' => 'bg-blue-500',
        ],
        'rejected' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-800',
            'border' => 'border-red-200',
            'icon' => 'heroicon-s-x-mark',
            'label' => 'Rechazado',
            'dot' => 'bg-red-500',
        ],
        'processing' => [
            'bg' => 'bg-indigo-100',
            'text' => 'text-indigo-800',
            'border' => 'border-indigo-200',
            'icon' => 'heroicon-s-cog-6-tooth',
            'label' => 'Procesando',
            'dot' => 'bg-indigo-500',
        ],
        'overdue' => [
            'bg' => 'bg-orange-100',
            'text' => 'text-orange-800',
            'border' => 'border-orange-200',
            'icon' => 'heroicon-s-exclamation-triangle',
            'label' => 'Vencido',
            'dot' => 'bg-orange-500',
        ],
        'completed' => [
            'bg' => 'bg-emerald-100',
            'text' => 'text-emerald-800',
            'border' => 'border-emerald-200',
            'icon' => 'heroicon-s-check-badge',
            'label' => 'Completado',
            'dot' => 'bg-emerald-500',
        ],
        'cancelled' => [
            'bg' => 'bg-gray-100',
            'text' => 'text-gray-800',
            'border' => 'border-gray-200',
            'icon' => 'heroicon-s-no-symbol',
            'label' => 'Cancelado',
            'dot' => 'bg-gray-500',
        ],
        'maintenance' => [
            'bg' => 'bg-purple-100',
            'text' => 'text-purple-800',
            'border' => 'border-purple-200',
            'icon' => 'heroicon-s-wrench-screwdriver',
            'label' => 'Mantenimiento',
            'dot' => 'bg-purple-500',
        ],
        'available' => [
            'bg' => 'bg-cyan-100',
            'text' => 'text-cyan-800',
            'border' => 'border-cyan-200',
            'icon' => 'heroicon-s-check',
            'label' => 'Disponible',
            'dot' => 'bg-cyan-500',
        ],
        'borrowed' => [
            'bg' => 'bg-amber-100',
            'text' => 'text-amber-800',
            'border' => 'border-amber-200',
            'icon' => 'heroicon-s-arrow-right-circle',
            'label' => 'Prestado',
            'dot' => 'bg-amber-500',
        ],
        'deleted' => [
            'bg' => 'bg-gray-200',
            'text' => 'text-gray-700',
            'border' => 'border-gray-300',
            'icon' => 'heroicon-s-trash',
            'label' => 'Eliminado',
            'dot' => 'bg-gray-500',
        ],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['active'];

    if ($customColors) {
        $config = array_merge($config, $customColors);
    }

    $baseClasses = 'inline-flex items-center font-medium rounded-full border';
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['sm'];
    $colorClasses = "{$config['bg']} {$config['text']} {$config['border']}";
    $classes = "$baseClasses $sizeClass $colorClasses";

    $iconSize = match ($size) {
        'xs' => 'w-3 h-3',
        'sm', 'md' => 'w-4 h-4',
        'lg' => 'w-5 h-5',
        'xl' => 'w-6 h-6',
        default => 'w-4 h-4',
    };

    $dotSize = match ($size) {
        'xs' => 'w-1.5 h-1.5',
        'sm', 'md' => 'w-2 h-2',
        'lg' => 'w-2.5 h-2.5',
        'xl' => 'w-3 h-3',
        default => 'w-2 h-2',
    };

    $displayLabel = $label ?? $config['label'];
    $displayIcon = $icon ?? $config['icon'];
@endphp

<span {{ $attributes->merge(['class' => $classes]) }} role="status" aria-label="{{ $displayLabel }}">
    @if ($type === 'dot')
        <span
            class="{{ $dotSize }} {{ $config['dot'] }} rounded-full mr-1.5 {{ $pulse ? 'animate-pulse' : '' }}"></span>
    @elseif($type === 'icon' || $type === 'default')
        <x-dynamic-component :component="$displayIcon" class="{{ $iconSize }} mr-1 {{ $pulse ? 'animate-pulse' : '' }}" />
    @endif

    {{ $displayLabel }}

    @if ($pulse && $type !== 'dot')
        <span class="{{ $dotSize }} {{ $config['dot'] }} rounded-full ml-1.5 animate-pulse"></span>
    @endif
</span>

@props([
    'type' => 'button',
    'variant' => 'primary',
])

@php
$base = 'inline-flex items-center justify-center px-4 py-2 rounded-md font-semibold text-sm transition focus:outline-none focus:ring-2';
$variants = [
    'primary' => 'bg-sena-verde text-white hover:bg-sena-verde-sec focus:ring-sena-verde',
    'secondary' => 'bg-white/20 text-white hover:bg-white/30 border border-white/30 focus:ring-white',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$base {$variants[$variant] ?? $variants['primary']}"]) }}>
    {{ $slot }}
</button>

{{-- card.blade.php --}}
{{-- This file defines a reusable card component with optional title and subtitle --}}
@props(['title' => null, 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'glass-card p-6 rounded-2xl shadow-md']) }}>
    @if ($title)
        <h2 class="mb-2 text-xl font-semibold text-sena-verde">{{ $title }}</h2>
    @endif

    @if ($subtitle)
        <p class="mb-4 text-sm text-sena-azul">{{ $subtitle }}</p>
    @endif

    {{ $slot }}
</div>

@props([
    'href',
    'label',
    'icon' => null,
    'active' => false
])

@php
    $isActive = $active || request()->url() === url($href);
@endphp

<a href="{{ $href }}"
   {{ $attributes->merge([
        'class' =>
            ($isActive
                ? 'text-white underline underline-offset-4 decoration-2'
                : 'text-white/80 hover:text-white hover:underline') .
            ' flex items-center gap-2 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-sena-azul'
    ]) }}
   aria-current="{{ $isActive ? 'page' : 'false' }}"
   aria-label="{{ $label }}">

    {{-- Icono opcional --}}
    @if ($icon)
        <x-dynamic-component :component="$icon" class="w-5 h-5" aria-hidden="true" />
    @endif

    {{ $label }}
</a>

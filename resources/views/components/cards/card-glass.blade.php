{{-- resources/views/components/cards/card-glass.blade.php --}}
@props(['title' => null, 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'card-glass']) }}>
    @if ($title)
        <h2 class="mb-2 text-xl font-semibold text-sena-verde">{{ $title }}</h2>
    @endif

    @if ($subtitle)
        <p class="mb-4 text-sm text-sena-azul">{{ $subtitle }}</p>
    @endif

    {{ $slot }}
</div>

{{-- card.blade.php --}}
{{-- This file defines a reusable card component with optional title and subtitle --}}
@props(['title', 'subtitle' => null])

<section class="mb-6 border-b shadow-inner bg-white/60 backdrop-blur-md border-sena-verde/20 rounded-xl">
    <div class="px-6 py-6 mx-auto max-w-7xl">
        <h1 class="mb-1 text-2xl font-bold text-sena-verde">{{ $title }}</h1>
        @if ($subtitle)
            <p class="text-sm text-sena-azul">{{ $subtitle }}</p>
        @endif
        {{ $slot }}
    </div>
</section>

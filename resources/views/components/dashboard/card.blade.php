{{-- resources/views/components/dashboard/card.blade.php --}}
@props([
    'icon',
    'title',
    'description',
    'route' => null,
    'label' => 'Ver más',
    'can' => null
])

@php
    $visible = is_null($can) || auth()->user()?->can($can);
@endphp

@if ($visible)
    <div role="region"
         class="p-6 transition duration-300 ease-in-out shadow-md rounded-2xl bg-white/70 backdrop-blur-sm ring-1 ring-sena-verde/10 hover:shadow-xl focus-within:ring-2 focus-within:ring-sena-verde">

        <div class="flex items-center gap-4 mb-4">
            <x-dynamic-component :component="$icon" class="w-6 h-6 text-sena-verde" aria-hidden="true" />
            <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
        </div>

        <p class="text-sm text-gray-600">{{ $description }}</p>

        @if ($route)
            <a href="{{ route($route) }}"
               class="inline-flex items-center gap-1 mt-4 text-sm font-semibold text-sena-verde hover:underline focus:outline focus-visible:ring-2 focus-visible:ring-sena-verde"
               aria-label="{{ $label }}">
                {{ $label }}
                <x-heroicon-o-arrow-right class="w-4 h-4" />
            </a>
        @endif
    </div>
@endif

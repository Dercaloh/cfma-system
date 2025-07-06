{{-- resources/views/components/legal/section-legal.blade.php --}}
@props(['title' => null, 'subtitle' => null])

<section class="max-w-6xl px-6 py-8 mx-auto my-8 shadow-lg bg-white/70 backdrop-blur-md rounded-2xl">
    @if ($title)
        <h1 class="mb-2 text-3xl font-bold text-center text-sena-verde">
            {{ $title }}
        </h1>
    @endif

    @if ($subtitle)
        <p class="mb-6 text-sm text-center text-gray-700">
            {{ $subtitle }}
        </p>
    @endif

    {{ $slot }}
</section>

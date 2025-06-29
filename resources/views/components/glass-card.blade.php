{{-- resources/views/components/glass-card.blade.php --}}
@props(['title' => null])

<div class="glass-card mb-6 p-4 rounded-xl shadow-md backdrop-blur bg-white/30 border border-white/40">
    @if ($title)
        <h3 class="text-xl font-semibold mb-2">{{ $title }}</h3>
    @endif

    {{ $slot }}
</div>

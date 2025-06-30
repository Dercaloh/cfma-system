{{-- resources/views/components/glass-card.blade.php --}}
@props(['title' => null])

<div class="bg-white/70 backdrop-blur-md rounded-xl shadow-md ring-1 ring-[#39A900] p-6 mb-6">
    @if ($title)
        <h3 class="text-xl font-semibold text-[#39A900] mb-3 font-sans">{{ $title }}</h3>
    @endif

    <div class="text-gray-800 text-sm">
        {{ $slot }}
    </div>
</div>

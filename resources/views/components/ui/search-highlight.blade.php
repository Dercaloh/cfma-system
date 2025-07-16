{{-- resources/views/components/ui/search-highlight.blade.php --}}
@props([
    'text',
    'search' => '',
])

@php
    $safeText = e($text);
@endphp

@if ($search && $text)
    @php
        // Escape el término de búsqueda
        $escapedSearch = preg_quote($search, '/');

        // Reemplazo con resaltado accesible
        $highlighted = preg_replace_callback("/($escapedSearch)/i", function ($match) {
            return '<mark class="search-highlight" aria-label="Texto resaltado por búsqueda">' . e($match[1]) . '</mark>';
        }, $safeText);
    @endphp

    {!! $highlighted !!}
@else
    {{ $text }}
@endif

{{-- resources/views/components/ui/search-highlight.blade.php --}}
@props([
    'text',
    'search' => ''
])

@if($search && $text)
    {!! preg_replace('/(' . preg_quote($search, '/') . ')/i', '<span class="search-highlight">$1</span>', e($text)) !!}
@else
    {{ $text }}
@endif

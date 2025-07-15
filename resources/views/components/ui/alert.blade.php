@props([
    'type' => 'info', // info, success, warning, error
    'title' => null,
    'icon' => null,
    'class' => ''
])

@php
    $types = [
        'info' => [
            'bg' => 'bg-blue-50',
            'border' => 'border-blue-500',
            'textTitle' => 'text-blue-900',
            'textContent' => 'text-blue-700',
            'iconDefault' => 'information-circle',
        ],
        'success' => [
            'bg' => 'bg-green-50',
            'border' => 'border-green-500',
            'textTitle' => 'text-green-900',
            'textContent' => 'text-green-700',
            'iconDefault' => 'check-circle',
        ],
        'warning' => [
            'bg' => 'bg-yellow-50',
            'border' => 'border-yellow-500',
            'textTitle' => 'text-yellow-900',
            'textContent' => 'text-yellow-700',
            'iconDefault' => 'exclamation-triangle',
        ],
        'error' => [
            'bg' => 'bg-red-50',
            'border' => 'border-red-500',
            'textTitle' => 'text-red-900',
            'textContent' => 'text-red-700',
            'iconDefault' => 'x-circle',
        ],
    ];

    $selected = $types[$type] ?? $types['info'];
    $iconName = $icon ?? $selected['iconDefault'];
@endphp

<div {{ $attributes->merge(['class' => "p-6 mb-6 border-l-4 rounded-r-lg {$selected['bg']} {$selected['border']} {$class}"]) }}>
    <div class="flex items-start gap-3">
        @svg("heroicon-o-{$iconName}", "w-5 h-5 mt-0.5 {$selected['textContent']}")
        <div>
            @if($title)
                <h3 class="font-semibold {{ $selected['textTitle'] }}">{{ $title }}</h3>
            @endif
            <div class="mt-1 text-sm {{ $selected['textContent'] }}">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

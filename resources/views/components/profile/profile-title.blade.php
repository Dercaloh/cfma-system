
{{--resources/views/components/profile/profile-title-blade-php --}}

@props([
    'icon' => 'user',
    'title' => '',
    'description' => '',
])

<div class="flex items-center mb-4 space-x-4">
    <svg class="w-6 h-6 text-sena-azul" fill="none" stroke="currentColor" stroke-width="1.5"
        viewBox="0 0 24 24">
        @switch($icon)
            @case('user')
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6A3.75 3.75 0 1 1 8.25 6a3.75 3.75 0 0 1 7.5 0zM4.5 20.25a8.25 8.25 0 0 1 15 0" />
                @break
            @case('lock')
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.5a4.5 4.5 0 1 0-9 0v3m9 0h1.5a1.5 1.5 0 0 1 1.5 1.5v6a1.5 1.5 0 0 1-1.5 1.5H6A1.5 1.5 0 0 1 4.5 18v-6a1.5 1.5 0 0 1 1.5-1.5H15z" />
                @break
            @case('settings')
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 3.75a6.75 6.75 0 1 1 0 13.5 6.75 6.75 0 0 1 0-13.5z" />
                @break
            @default
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
        @endswitch
    </svg>

    <div>
        <h3 class="text-lg font-semibold text-sena-azul">{{ $title }}</h3>
        @if ($description)
            <p class="text-sm text-gray-600">{{ $description }}</p>
        @endif
    </div>
</div>

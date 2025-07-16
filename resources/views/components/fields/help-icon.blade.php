@props([
    'title' => 'Más información'
])

<span
    class="inline-block ml-1 text-blue-600 cursor-pointer group focus:outline-none"
    role="button"
    tabindex="0"
    aria-label="{{ $title }}"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M12 6.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
    </svg>
    <span class="absolute z-10 hidden w-64 p-2 mt-1 text-sm text-white transition-opacity duration-150 ease-in-out bg-gray-800 rounded shadow-lg group-hover:block group-focus:block">
        {{ $title }}
    </span>
</span>

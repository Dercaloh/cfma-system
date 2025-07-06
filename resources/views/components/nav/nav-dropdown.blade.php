@props([
    'label' => 'Menú',
    'items' => [], // ['label' => 'Texto', 'href' => 'ruta', 'icon' => 'heroicon-o-user']
])

<div class="relative group">
    <button
        class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white rounded-md bg-sena-verde/70 hover:bg-sena-verde-sec focus:outline-none focus-visible:ring-2 focus-visible:ring-sena-azul"
        aria-haspopup="true"
        aria-expanded="false">
        {{ $label }}
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 111.08 1.04l-4.24 4.24a.75.75 0 01-1.08 0l-4.24-4.24a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
    </button>

    <div class="absolute left-0 z-10 hidden w-56 mt-2 border rounded-md shadow-lg group-hover:block bg-white/90 backdrop-blur-md border-sena-verde/20">
        <ul class="py-1 text-sm text-sena-azul">
            @foreach ($items as $item)
                <li>
                    <a href="{{ $item['href'] }}"
                       class="flex items-center gap-2 px-4 py-2 transition hover:bg-sena-verde/10 focus:outline-none focus:bg-sena-verde/20"
                       aria-label="{{ $item['label'] }}">

                        @if (!empty($item['icon']))
                            <x-dynamic-component :component="$item['icon']" class="w-5 h-5" aria-hidden="true" />
                        @endif

                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

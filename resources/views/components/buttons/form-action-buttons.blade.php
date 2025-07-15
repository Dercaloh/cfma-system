@props([
    'cancelHref' => null,
    'cancelText' => 'Cancelar',
    'submitText' => 'Guardar Cambios',
])

<div class="flex flex-col gap-3 pt-6 border-t sm:flex-row sm:items-center sm:justify-between border-sena-gris/30">
    <div class="text-sm text-sena-azul/70 font-secondary">
        @svg('heroicon-o-lock-closed', 'inline w-4 h-4 mr-1')
        Cambios registrados en auditoría del sistema
    </div>

    <div class="flex gap-3">
        @if ($cancelHref)
            <a href="{{ $cancelHref }}"
                class="inline-flex items-center gap-2 px-4 py-2 font-medium transition-all duration-200 border rounded-lg text-sena-azul bg-sena-gris/50 border-sena-gris/30 shadow-neumorph hover:shadow-neumorph-hover hover:bg-sena-gris/70 focus:outline-none focus:ring-2 focus:ring-sena-azul/20 focus:ring-offset-2">
                @svg('heroicon-o-x-mark', 'w-5 h-5')
                <span>{{ $cancelText }}</span>
            </a>
        @endif

        <button type="submit"
            class="inline-flex items-center gap-2 px-4 py-2 font-medium text-white transition-all duration-200 rounded-lg bg-gradient-to-r from-sena-verde to-sena-verde-sec shadow-neumorph hover:shadow-neumorph-hover focus:outline-none focus:ring-2 focus:ring-sena-verde/20 focus:ring-offset-2">
            @svg('heroicon-o-check', 'w-5 h-5')
            <span>{{ $submitText }}</span>
        </button>
    </div>
</div>

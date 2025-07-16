{{-- resources/views/components/qr-code/qr-display.blade.php --}}
@props([
    'data' => '',
    'title' => '',
    'subtitle' => '',
    'size' => 200,
    'showInfo' => true,
    'downloadable' => false,
    'logo' => null,
    'logoSize' => 40,
    'errorLevel' => 'M',
    'margin' => 4,
    'foregroundColor' => '#000000',
    'backgroundColor' => '#ffffff',
    'description' => '',
    'extraInfo' => [],
    'centered' => false,
    'bordered' => true,
    'animated' => true,
    'compact' => false
])

@php
    $qrId = 'qr-' . uniqid();
    $canvasId = 'canvas-' . uniqid();
    $containerId = 'container-' . uniqid();

    // Configurar nivel de corrección de errores
    $errorLevels = [
        'L' => 'Low',
        'M' => 'Medium',
        'Q' => 'Quartile',
        'H' => 'High'
    ];
@endphp

<div
    id="{{ $containerId }}"
    class="qr-display-container {{ $centered ? 'mx-auto text-center' : '' }} {{ $compact ? 'compact-mode' : '' }}"
    role="region"
    aria-labelledby="{{ $qrId }}-title"
    aria-describedby="{{ $qrId }}-desc"
>
    {{-- Header con título --}}
    @if($title || $subtitle)
        <div class="qr-header mb-4 {{ $centered ? 'text-center' : '' }}">
            @if($title)
                <h3
                    id="{{ $qrId }}-title"
                    class="mb-1 text-lg font-semibold text-sena-azul"
                >
                    {{ $title }}
                </h3>
            @endif

            @if($subtitle)
                <p class="mb-2 text-sm text-sena-gris-600">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
    @endif

    {{-- Contenedor principal del QR --}}
    <div class="qr-main-container {{ $compact ? 'flex items-start gap-4' : '' }}">

        {{-- Contenedor del código QR --}}
        <div class="qr-code-wrapper {{ $bordered ? 'glass-card p-4' : '' }} {{ $animated ? 'animate-fade-in' : '' }} inline-block">

            {{-- Canvas para el QR --}}
            <div class="relative overflow-hidden bg-white rounded-lg qr-canvas-container"
                 style="width: {{ $size }}px; height: {{ $size }}px;">

                <canvas
                    id="{{ $canvasId }}"
                    width="{{ $size }}"
                    height="{{ $size }}"
                    class="block qr-canvas"
                    aria-label="Código QR: {{ $data }}"
                    role="img"
                ></canvas>

                {{-- Logo superpuesto --}}
                @if($logo)
                    <div class="absolute p-1 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-full shadow-md qr-logo top-1/2 left-1/2"
                         style="width: {{ $logoSize }}px; height: {{ $logoSize }}px;">
                        <img
                            src="{{ $logo }}"
                            alt="Logo institucional"
                            class="object-contain w-full h-full rounded-full"
                        />
                    </div>
                @endif

                {{-- Indicador de carga --}}
                <div id="{{ $qrId }}-loading"
                     class="absolute inset-0 flex items-center justify-center qr-loading bg-white/90">
                    <div class="w-8 h-8 border-2 rounded-full animate-spin border-sena-verde border-t-transparent"></div>
                </div>
            </div>

            {{-- Botón de descarga --}}
            @if($downloadable)
                <div class="qr-download mt-3 {{ $centered ? 'text-center' : '' }}">
                    <button
                        id="{{ $qrId }}-download"
                        type="button"
                        class="btn-sena text-sm px-3 py-1.5 inline-flex items-center gap-2 sena-focus"
                        onclick="downloadQR('{{ $canvasId }}', '{{ $title ?: 'QR-Code' }}')"
                        aria-label="Descargar código QR como imagen"
                    >
                        <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
                        Descargar
                    </button>
                </div>
            @endif
        </div>

        {{-- Panel de información --}}
        @if($showInfo && ($description || !empty($extraInfo)))
            <div class="qr-info {{ $compact ? 'flex-1' : 'mt-4' }}">
                <div class="p-4 space-y-3 glass-card">

                    {{-- Descripción --}}
                    @if($description)
                        <div class="qr-description">
                            <p
                                id="{{ $qrId }}-desc"
                                class="text-sm leading-relaxed text-sena-gris-700"
                            >
                                {{ $description }}
                            </p>
                        </div>
                    @endif

                    {{-- Información extra --}}
                    @if(!empty($extraInfo))
                        <div class="space-y-2 qr-extra-info">
                            @foreach($extraInfo as $label => $value)
                                <div class="flex items-center justify-between text-sm info-item">
                                    <span class="font-medium text-sena-azul">{{ $label }}:</span>
                                    <span class="text-sena-gris-600">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Información técnica del QR --}}
                    <div class="pt-2 border-t qr-tech-info border-sena-gris-200">
                        <div class="grid grid-cols-2 gap-2 text-xs text-sena-gris-500">
                            <div>Tamaño: {{ $size }}px</div>
                            <div>Corrección: {{ $errorLevels[$errorLevel] ?? 'Medium' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Estilos CSS --}}
<style>
.qr-display-container {
    max-width: 100%;
}

.qr-display-container.compact-mode {
    max-width: 600px;
}

.qr-canvas-container {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.qr-loading {
    transition: opacity 0.3s ease;
}

.qr-loading.hidden {
    opacity: 0;
    pointer-events: none;
}

.info-item {
    padding: 0.25rem 0;
}

.info-item:not(:last-child) {
    border-bottom: 1px solid rgba(246, 246, 246, 0.5);
}

@media (max-width: 640px) {
    .qr-display-container.compact-mode .qr-main-container {
        flex-direction: column;
        gap: 1rem;
    }

    .qr-canvas-container {
        margin: 0 auto;
    }
}
</style>

{{-- JavaScript para generar QR --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    generateQRCode();
});

function generateQRCode() {
    const canvas = document.getElementById('{{ $canvasId }}');
    const loading = document.getElementById('{{ $qrId }}-loading');

    if (!canvas || !window.QRious) {
        console.error('QRious library not loaded or canvas not found');
        return;
    }

    try {
        const qr = new QRious({
            element: canvas,
            value: '{{ addslashes($data) }}',
            size: {{ $size }},
            level: '{{ $errorLevel }}',
            background: '{{ $backgroundColor }}',
            foreground: '{{ $foregroundColor }}',
            padding: {{ $margin }}
        });

        // Ocultar loading
        setTimeout(() => {
            loading.classList.add('hidden');
        }, 300);

    } catch (error) {
        console.error('Error generating QR code:', error);
        canvas.getContext('2d').fillText('Error generando QR', 10, 30);
        loading.classList.add('hidden');
    }
}

function downloadQR(canvasId, filename) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;

    try {
        const link = document.createElement('a');
        link.download = filename + '.png';
        link.href = canvas.toDataURL();
        link.click();
    } catch (error) {
        console.error('Error downloading QR:', error);
        alert('Error al descargar el código QR');
    }
}
</script>

{{-- Dependencia QRious (incluir en layout principal) --}}
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
@endpush

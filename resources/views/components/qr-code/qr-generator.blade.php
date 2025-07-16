{{-- resources/views/components/qr-code/qr-generator.blade.php --}}
@props([
    'data' => '',
    'size' => '200',
    'logo' => null,
    'title' => '',
    'downloadable' => true,
    'format' => 'png',
    'errorCorrection' => 'M',
    'foregroundColor' => '#000000',
    'backgroundColor' => '#FFFFFF',
    'margin' => 0,
    'name' => 'qr-code',
    'showInfo' => true,
    'containerClass' => '',
    'id' => null
])

@php
    $componentId = $id ?? 'qr-' . uniqid();
    $canvasId = $componentId . '-canvas';
    $downloadId = $componentId . '-download';
@endphp

<div class="qr-generator-container {{ $containerClass }}" id="{{ $componentId }}">
    <!-- Header con título si está disponible -->
    @if($title)
        <div class="mb-4">
            <h3 class="flex items-center gap-2 text-lg font-semibold text-sena-azul-900">
                <x-heroicon-o-qr-code class="w-5 h-5" />
                {{ $title }}
            </h3>
        </div>
    @endif

    <!-- Container principal con efecto glass -->
    <div class="p-6 border bg-white/90 backdrop-blur-sm border-sena-gris-300 rounded-xl shadow-neumorph">

        <!-- Canvas container -->
        <div class="flex flex-col items-center space-y-4">

            <!-- QR Code Canvas -->
            <div class="relative">
                <canvas
                    id="{{ $canvasId }}"
                    width="{{ $size }}"
                    height="{{ $size }}"
                    class="border-2 rounded-lg border-sena-gris-200 shadow-neumorph-inset"
                    style="max-width: 100%; height: auto;"
                    role="img"
                    aria-label="Código QR{{ $title ? ' para ' . $title : '' }}"
                ></canvas>

                <!-- Logo overlay si está disponible -->
                @if($logo)
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="p-2 bg-white rounded-full shadow-lg" style="width: {{ $size * 0.2 }}px; height: {{ $size * 0.2 }}px;">
                            <img
                                src="{{ $logo }}"
                                alt="Logo institucional"
                                class="object-contain w-full h-full"
                            >
                        </div>
                    </div>
                @endif
            </div>

            <!-- Información del QR -->
            @if($showInfo && $data)
                <div class="space-y-2 text-center">
                    <div class="text-sm font-medium text-sena-azul-700">
                        Datos codificados:
                    </div>
                    <div class="max-w-xs px-3 py-2 font-mono text-xs break-all rounded-lg text-sena-gris-600 bg-sena-gris-100">
                        {{ Str::limit($data, 50) }}
                    </div>
                </div>
            @endif

            <!-- Botones de acción -->
            <div class="flex flex-wrap justify-center gap-3">
                @if($downloadable)
                    <button
                        type="button"
                        id="{{ $downloadId }}"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium btn-sena"
                        aria-label="Descargar código QR"
                    >
                        <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
                        Descargar
                    </button>
                @endif

                <button
                    type="button"
                    onclick="regenerateQR('{{ $componentId }}')"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium transition-colors rounded-lg bg-sena-gris-200 hover:bg-sena-gris-300 text-sena-azul-700"
                    aria-label="Regenerar código QR"
                >
                    <x-heroicon-o-arrow-path class="w-4 h-4" />
                    Regenerar
                </button>
            </div>
        </div>
    </div>

    <!-- Estado de carga -->
    <div id="{{ $componentId }}-loading" class="hidden">
        <div class="flex items-center justify-center p-8">
            <div class="w-8 h-8 border-b-2 rounded-full animate-spin border-sena-verde"></div>
            <span class="ml-2 text-sena-gris-600">Generando código QR...</span>
        </div>
    </div>

    <!-- Mensaje de error -->
    <div id="{{ $componentId }}-error" class="hidden">
        <div class="p-4 mt-4 border border-red-200 rounded-lg bg-red-50">
            <div class="flex items-center gap-2">
                <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-red-500" />
                <span class="font-medium text-red-700">Error al generar el código QR</span>
            </div>
            <p class="mt-1 text-sm text-red-600" id="{{ $componentId }}-error-message"></p>
        </div>
    </div>
</div>

@push('styles')
<style>
    .qr-generator-container canvas {
        image-rendering: pixelated;
        image-rendering: -moz-crisp-edges;
        image-rendering: crisp-edges;
    }

    .qr-generator-container .btn-sena {
        background: linear-gradient(135deg, #39A900 0%, #007832 100%);
        color: white;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(57, 169, 0, 0.1);
    }

    .qr-generator-container .btn-sena:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 15px -3px rgba(57, 169, 0, 0.2);
    }

    .qr-generator-container .btn-sena:active {
        transform: translateY(0);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar QR Generator
    initQRGenerator('{{ $componentId }}', {
        data: @json($data),
        size: {{ $size }},
        foregroundColor: '{{ $foregroundColor }}',
        backgroundColor: '{{ $backgroundColor }}',
        errorCorrection: '{{ $errorCorrection }}',
        margin: {{ $margin }},
        format: '{{ $format }}',
        downloadable: {{ $downloadable ? 'true' : 'false' }},
        name: '{{ $name }}'
    });
});

function initQRGenerator(containerId, options) {
    const container = document.getElementById(containerId);
    const canvas = document.getElementById(containerId + '-canvas');
    const downloadBtn = document.getElementById(containerId + '-download');
    const loadingEl = document.getElementById(containerId + '-loading');
    const errorEl = document.getElementById(containerId + '-error');
    const errorMessage = document.getElementById(containerId + '-error-message');

    if (!container || !canvas) {
        console.error('QR Generator: Container or canvas not found');
        return;
    }

    let qr = null;

    function showLoading() {
        canvas.style.display = 'none';
        loadingEl.classList.remove('hidden');
        errorEl.classList.add('hidden');
    }

    function hideLoading() {
        canvas.style.display = 'block';
        loadingEl.classList.add('hidden');
    }

    function showError(message) {
        errorMessage.textContent = message;
        errorEl.classList.remove('hidden');
        loadingEl.classList.add('hidden');
    }

    function generateQR() {
        if (!options.data) {
            showError('No hay datos para generar el código QR');
            return;
        }

        showLoading();

        try {
            // Pequeño delay para mostrar el loading
            setTimeout(() => {
                qr = new QRious({
                    element: canvas,
                    value: options.data,
                    size: options.size,
                    foreground: options.foregroundColor,
                    background: options.backgroundColor,
                    level: options.errorCorrection,
                    margin: options.margin
                });

                hideLoading();

                // Configurar descarga si está habilitada
                if (options.downloadable && downloadBtn) {
                    setupDownload();
                }
            }, 300);
        } catch (error) {
            showError('Error al generar el código QR: ' + error.message);
        }
    }

    function setupDownload() {
        downloadBtn.addEventListener('click', function() {
            if (!qr) return;

            try {
                const link = document.createElement('a');
                link.download = options.name + '-qr-code.' + options.format;
                link.href = canvas.toDataURL('image/' + options.format);

                // Crear evento de clic y dispararlo
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Feedback visual
                const originalText = downloadBtn.innerHTML;
                downloadBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Descargado';
                downloadBtn.disabled = true;

                setTimeout(() => {
                    downloadBtn.innerHTML = originalText;
                    downloadBtn.disabled = false;
                }, 2000);

            } catch (error) {
                showError('Error al descargar: ' + error.message);
            }
        });
    }

    // Función global para regenerar
    window.regenerateQR = function(containerId) {
        if (containerId === containerId) {
            generateQR();
        }
    };

    // Función global para actualizar datos
    window.updateQRData = function(containerId, newData) {
        if (containerId === containerId) {
            options.data = newData;
            generateQR();
        }
    };

    // Generar QR inicial
    generateQR();

    // Hacer el objeto accesible globalmente para actualizaciones
    window.qrGenerators = window.qrGenerators || {};
    window.qrGenerators[containerId] = {
        update: function(newData) {
            options.data = newData;
            generateQR();
        },
        regenerate: function() {
            generateQR();
        },
        download: function() {
            if (downloadBtn) {
                downloadBtn.click();
            }
        }
    };
}

// Función de utilidad para navegación por teclado
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' || e.key === ' ') {
        const target = e.target;
        if (target.tagName === 'BUTTON' && target.closest('.qr-generator-container')) {
            e.preventDefault();
            target.click();
        }
    }
});
</script>
@endpush

{{-- resources/views/components/qr-code/qr-scanner.blade.php --}}
@props([
    'name' => 'qr_code',
    'label' => 'Escanear código QR',
    'placeholder' => 'Posiciona el código QR frente a la cámara',
    'required' => false,
    'width' => '100%',
    'height' => '300px',
    'onScan' => null,
    'showManualInput' => true,
    'autoStart' => true,
    'cameraFacing' => 'environment' // 'user' para frontal, 'environment' para trasera
])

<div class="qr-scanner-container"
     x-data="qrScanner({
        name: '{{ $name }}',
        onScan: {{ $onScan ? $onScan : 'null' }},
        autoStart: {{ $autoStart ? 'true' : 'false' }},
        cameraFacing: '{{ $cameraFacing }}'
     })"
     x-init="init()">

    {{-- Label --}}
    @if($label)
        <label class="block mb-3 text-sm font-semibold text-sena-azul">
            {{ $label }}
            @if($required)
                <span class="ml-1 text-red-500">*</span>
            @endif
        </label>
    @endif

    {{-- Scanner Container --}}
    <div class="max-w-md p-6 mx-auto glass-card">

        {{-- Video Container --}}
        <div class="relative mb-4" style="width: {{ $width }}; height: {{ $height }};">
            {{-- Video Element --}}
            <video x-ref="video"
                   class="object-cover w-full h-full border-2 rounded-lg border-sena-verde/30"
                   style="display: none;"
                   autoplay
                   muted
                   playsinline>
            </video>

            {{-- Canvas for processing --}}
            <canvas x-ref="canvas"
                    class="hidden"
                    width="640"
                    height="480">
            </canvas>

            {{-- Scanner Overlay --}}
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="scanner-overlay">
                    <div class="border-2 rounded-lg scanner-box border-sena-verde">
                        <div class="scanner-corner scanner-corner-tl"></div>
                        <div class="scanner-corner scanner-corner-tr"></div>
                        <div class="scanner-corner scanner-corner-bl"></div>
                        <div class="scanner-corner scanner-corner-br"></div>
                        <div class="scanner-line" x-show="scanning"></div>
                    </div>
                </div>
            </div>

            {{-- Status Messages --}}
            <div class="absolute transform -translate-x-1/2 pointer-events-none bottom-4 left-1/2">
                <div x-show="!cameraReady && !error"
                     class="px-3 py-1 text-sm text-white rounded bg-black/70">
                    Iniciando cámara...
                </div>
                <div x-show="cameraReady && scanning"
                     class="px-3 py-1 text-sm text-white rounded bg-sena-verde/80">
                    {{ $placeholder }}
                </div>
                <div x-show="error"
                     class="px-3 py-1 text-sm text-white rounded bg-red-500/80"
                     x-text="errorMessage">
                </div>
            </div>
        </div>

        {{-- Controls --}}
        <div class="flex justify-center gap-3 mb-4">
            <button type="button"
                    @click="toggleScanner()"
                    class="flex items-center gap-2 btn-sena"
                    :class="{ 'bg-red-500 hover:bg-red-600': scanning, 'bg-sena-verde hover:bg-sena-verde-sec': !scanning }">
                <x-heroicon-o-play x-show="!scanning" class="w-4 h-4"/>
                <x-heroicon-o-pause x-show="scanning" class="w-4 h-4"/>
                <span x-text="scanning ? 'Detener' : 'Iniciar'"></span>
            </button>

            <button type="button"
                    @click="switchCamera()"
                    class="flex items-center gap-2 btn-sena bg-sena-azul hover:bg-sena-azul/80"
                    :disabled="!cameraReady">
                <x-heroicon-o-camera class="w-4 h-4"/>
                <span>Cambiar</span>
            </button>
        </div>

        {{-- Manual Input (Optional) --}}
        @if($showManualInput)
            <div class="pt-4 border-t border-sena-gris">
                <label class="block mb-2 text-sm font-medium text-sena-azul">
                    O ingresa el código manualmente:
                </label>
                <div class="flex gap-2">
                    <input type="text"
                           x-model="manualCode"
                           class="flex-1 form-input"
                           placeholder="Código QR"
                           @keyup.enter="processManualCode()">
                    <button type="button"
                            @click="processManualCode()"
                            class="btn-sena bg-sena-azul hover:bg-sena-azul/80">
                        <x-heroicon-o-check class="w-4 h-4"/>
                    </button>
                </div>
            </div>
        @endif

        {{-- Result Display --}}
        <div x-show="scannedCode"
             class="p-3 mt-4 border border-green-200 rounded-lg bg-green-50">
            <div class="flex items-center gap-2 text-green-800">
                <x-heroicon-o-check-circle class="w-5 h-5"/>
                <span class="font-medium">Código escaneado:</span>
            </div>
            <div class="mt-1 font-mono text-sm text-green-700 break-all"
                 x-text="scannedCode">
            </div>
        </div>
    </div>

    {{-- Hidden Input --}}
    <input type="hidden"
           :name="name"
           :value="scannedCode"
           x-ref="hiddenInput">
</div>

{{-- Styles --}}
<style>
.scanner-overlay {
    width: 200px;
    height: 200px;
    position: relative;
}

.scanner-box {
    width: 100%;
    height: 100%;
    position: relative;
    background: rgba(0, 0, 0, 0.1);
}

.scanner-corner {
    position: absolute;
    width: 20px;
    height: 20px;
    border: 3px solid #39A900;
}

.scanner-corner-tl {
    top: -2px;
    left: -2px;
    border-right: none;
    border-bottom: none;
}

.scanner-corner-tr {
    top: -2px;
    right: -2px;
    border-left: none;
    border-bottom: none;
}

.scanner-corner-bl {
    bottom: -2px;
    left: -2px;
    border-right: none;
    border-top: none;
}

.scanner-corner-br {
    bottom: -2px;
    right: -2px;
    border-left: none;
    border-top: none;
}

.scanner-line {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: #39A900;
    animation: scan 2s linear infinite;
}

@keyframes scan {
    0% { transform: translateY(0); }
    100% { transform: translateY(198px); }
}
</style>

{{-- JavaScript --}}
<script>
function qrScanner(config) {
    return {
        name: config.name,
        onScan: config.onScan,
        autoStart: config.autoStart,
        cameraFacing: config.cameraFacing,

        // Estado
        scanning: false,
        cameraReady: false,
        error: false,
        errorMessage: '',
        scannedCode: '',
        manualCode: '',

        // Referencias
        video: null,
        canvas: null,
        stream: null,
        scanInterval: null,

        init() {
            this.video = this.$refs.video;
            this.canvas = this.$refs.canvas;

            if (this.autoStart) {
                this.startCamera();
            }
        },

        async startCamera() {
            try {
                this.error = false;
                this.errorMessage = '';

                const constraints = {
                    video: {
                        facingMode: this.cameraFacing,
                        width: { ideal: 640 },
                        height: { ideal: 480 }
                    }
                };

                this.stream = await navigator.mediaDevices.getUserMedia(constraints);
                this.video.srcObject = this.stream;
                this.video.style.display = 'block';

                this.video.addEventListener('loadedmetadata', () => {
                    this.cameraReady = true;
                    if (this.autoStart) {
                        this.startScanning();
                    }
                });

            } catch (err) {
                this.error = true;
                this.errorMessage = 'Error al acceder a la cámara: ' + err.message;
                console.error('Error:', err);
            }
        },

        stopCamera() {
            if (this.stream) {
                this.stream.getTracks().forEach(track => track.stop());
                this.stream = null;
            }
            this.video.style.display = 'none';
            this.cameraReady = false;
        },

        startScanning() {
            if (!this.cameraReady) return;

            this.scanning = true;
            this.scanInterval = setInterval(() => {
                this.scanFrame();
            }, 100);
        },

        stopScanning() {
            this.scanning = false;
            if (this.scanInterval) {
                clearInterval(this.scanInterval);
                this.scanInterval = null;
            }
        },

        scanFrame() {
            if (!this.video || !this.canvas) return;

            const context = this.canvas.getContext('2d');
            context.drawImage(this.video, 0, 0, 640, 480);

            const imageData = context.getImageData(0, 0, 640, 480);
            const code = this.decodeQR(imageData);

            if (code) {
                this.processScannedCode(code);
            }
        },

        decodeQR(imageData) {
            // Implementación básica de detección QR
            // En producción, usar una librería como jsQR
            try {
                // Simulación de decodificación
                // Aquí iría la lógica real de jsQR
                return null;
            } catch (err) {
                return null;
            }
        },

        processScannedCode(code) {
            this.scannedCode = code;
            this.stopScanning();

            // Ejecutar callback si existe
            if (this.onScan && typeof this.onScan === 'function') {
                this.onScan(code);
            }

            // Disparar evento personalizado
            this.$dispatch('qr-scanned', { code: code });
        },

        processManualCode() {
            if (this.manualCode.trim()) {
                this.processScannedCode(this.manualCode.trim());
                this.manualCode = '';
            }
        },

        toggleScanner() {
            if (this.scanning) {
                this.stopScanning();
            } else {
                if (!this.cameraReady) {
                    this.startCamera();
                } else {
                    this.startScanning();
                }
            }
        },

        async switchCamera() {
            this.stopCamera();
            this.cameraFacing = this.cameraFacing === 'environment' ? 'user' : 'environment';
            await this.startCamera();
        }
    }
}
</script>

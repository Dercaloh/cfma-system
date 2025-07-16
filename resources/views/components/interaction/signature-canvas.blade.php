{{-- resources/views/components/interaction/signature-canvas.blade.php --}}
{{--
    Componente de Firma Digital - SGPTI
    Centro de Formación Minero Ambiental SENA

    Características:
    - Canvas responsivo para captura de firmas
    - Validación en tiempo real
    - Exportación a base64
    - Accesibilidad WCAG 2.1 AA
    - Estilos neumorphism light

    Uso:
    <x-interaction.signature-canvas
        name="firma_responsable"
        label="Firma del responsable"
        width="400"
        height="200"
        required="true"
    />
--}}

@props([
    'name' => 'signature',
    'label' => 'Firma Digital',
    'width' => 400,
    'height' => 200,
    'required' => false,
    'placeholder' => 'Firme aquí...',
    'helpText' => null,
    'clearText' => 'Limpiar',
    'saveText' => 'Guardar Firma',
    'disabled' => false,
    'backgroundColor' => '#ffffff',
    'penColor' => '#000000',
    'penWidth' => 2,
    'value' => null
])

@php
    $id = $attributes->get('id', 'signature-' . $name);
    $classes = 'relative w-full max-w-lg mx-auto';
    $canvasId = $id . '-canvas';
    $hiddenInputId = $id . '-input';
@endphp

<div class="{{ $classes }}"
     x-data="signatureCanvas('{{ $canvasId }}', '{{ $hiddenInputId }}', {
        backgroundColor: '{{ $backgroundColor }}',
        penColor: '{{ $penColor }}',
        penWidth: {{ $penWidth }},
        disabled: {{ $disabled ? 'true' : 'false' }},
        required: {{ $required ? 'true' : 'false' }},
        initialValue: '{{ $value }}'
     })"
     x-init="init()"
     role="group"
     aria-labelledby="{{ $id }}-label">

    {{-- Label --}}
    <label id="{{ $id }}-label"
           class="block mb-2 text-sm font-semibold text-sena-azul">
        {{ $label }}
        @if($required)
            <span class="ml-1 text-red-500" aria-label="requerido">*</span>
        @endif
    </label>

    {{-- Help Text --}}
    @if($helpText)
        <p class="mb-3 text-sm text-gray-600" id="{{ $id }}-help">
            {{ $helpText }}
        </p>
    @endif

    {{-- Signature Container --}}
    <div class="p-4 space-y-4 glass-card">
        {{-- Canvas Container --}}
        <div class="relative overflow-hidden border-2 border-dashed rounded-lg border-sena-verde/30"
             :class="{ 'border-red-300': hasError, 'border-sena-verde': isSigned }">

            {{-- Canvas --}}
            <canvas
                id="{{ $canvasId }}"
                class="block bg-white cursor-crosshair touch-none"
                :class="{ 'cursor-not-allowed opacity-50': disabled }"
                width="{{ $width }}"
                height="{{ $height }}"
                style="max-width: 100%; height: auto;"
                @touchstart.prevent="handleTouchStart($event)"
                @touchmove.prevent="handleTouchMove($event)"
                @touchend.prevent="handleTouchEnd($event)"
                @mousedown.prevent="handleMouseDown($event)"
                @mousemove.prevent="handleMouseMove($event)"
                @mouseup.prevent="handleMouseUp($event)"
                @mouseleave.prevent="handleMouseLeave($event)"
                role="img"
                :aria-label="isSigned ? 'Firma capturada' : 'Canvas para firmar'"
                tabindex="0"
                @keydown="handleKeyDown($event)">
            </canvas>

            {{-- Placeholder --}}
            <div x-show="!isSigned && !disabled"
                 class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="flex items-center space-x-2 text-sm text-gray-400">
                    <x-heroicon-o-pencil class="w-4 h-4" />
                    <span>{{ $placeholder }}</span>
                </div>
            </div>

            {{-- Status Indicator --}}
            <div class="absolute top-2 right-2">
                <div x-show="isSigned"
                     class="flex items-center px-2 py-1 space-x-1 text-xs rounded-full bg-sena-verde/10 text-sena-verde">
                    <x-heroicon-s-check class="w-3 h-3" />
                    <span>Firmado</span>
                </div>
                <div x-show="hasError"
                     class="flex items-center px-2 py-1 space-x-1 text-xs text-red-600 rounded-full bg-red-50">
                    <x-heroicon-s-exclamation-triangle class="w-3 h-3" />
                    <span>Error</span>
                </div>
            </div>
        </div>

        {{-- Controls --}}
        <div class="flex items-center justify-between">
            {{-- Clear Button --}}
            <button type="button"
                    @click="clearSignature()"
                    :disabled="!isSigned || disabled"
                    class="inline-flex items-center px-3 py-2 space-x-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                    :class="{ 'hover:border-red-300 hover:text-red-600': isSigned && !disabled }">
                <x-heroicon-o-trash class="w-4 h-4" />
                <span>{{ $clearText }}</span>
            </button>

            {{-- Info --}}
            <div class="flex items-center space-x-1 text-xs text-gray-500">
                <x-heroicon-o-information-circle class="w-4 h-4" />
                <span x-text="getSignatureInfo()"></span>
            </div>
        </div>
    </div>

    {{-- Hidden Input --}}
    <input type="hidden"
           id="{{ $hiddenInputId }}"
           name="{{ $name }}"
           :value="signatureData"
           x-model="signatureData" />

    {{-- Error Message --}}
    <div x-show="hasError && errorMessage"
         class="flex items-center mt-2 space-x-1 text-sm text-red-600"
         role="alert">
        <x-heroicon-s-exclamation-triangle class="w-4 h-4" />
        <span x-text="errorMessage"></span>
    </div>

    {{-- Validation Message --}}
    @error($name)
        <div class="flex items-center mt-2 space-x-1 text-sm text-red-600" role="alert">
            <x-heroicon-s-exclamation-triangle class="w-4 h-4" />
            <span>{{ $message }}</span>
        </div>
    @enderror
</div>

{{-- Styles --}}
<style>
    /* Optimización para dispositivos táctiles */
    .touch-none {
        touch-action: none;
    }

    /* Cursor personalizado para canvas */
    .cursor-crosshair {
        cursor: crosshair;
    }

    /* Animaciones suaves */
    .signature-canvas-container {
        transition: all 0.3s ease;
    }

    /* Responsive canvas */
    @media (max-width: 640px) {
        .signature-canvas-container canvas {
            width: 100% !important;
            height: auto !important;
        }
    }
</style>

{{-- JavaScript --}}
<script>
    function signatureCanvas(canvasId, inputId, options = {}) {
        return {
            // Configuración
            canvas: null,
            ctx: null,
            isDrawing: false,
            isSigned: false,
            hasError: false,
            errorMessage: '',
            signatureData: '',

            // Opciones
            backgroundColor: options.backgroundColor || '#ffffff',
            penColor: options.penColor || '#000000',
            penWidth: options.penWidth || 2,
            disabled: options.disabled || false,
            required: options.required || false,

            // Estado del dibujo
            lastX: 0,
            lastY: 0,

            // Inicialización
            init() {
                this.canvas = document.getElementById(canvasId);
                this.ctx = this.canvas.getContext('2d');

                if (!this.canvas || !this.ctx) {
                    this.setError('Error al inicializar el canvas de firma');
                    return;
                }

                this.setupCanvas();

                // Cargar firma existente si existe
                if (options.initialValue) {
                    this.loadSignature(options.initialValue);
                }
            },

            // Configurar canvas
            setupCanvas() {
                this.ctx.strokeStyle = this.penColor;
                this.ctx.lineWidth = this.penWidth;
                this.ctx.lineCap = 'round';
                this.ctx.lineJoin = 'round';
                this.ctx.fillStyle = this.backgroundColor;
                this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
            },

            // Eventos táctiles
            handleTouchStart(e) {
                if (this.disabled) return;

                const touch = e.touches[0];
                const rect = this.canvas.getBoundingClientRect();
                const scaleX = this.canvas.width / rect.width;
                const scaleY = this.canvas.height / rect.height;

                this.startDrawing(
                    (touch.clientX - rect.left) * scaleX,
                    (touch.clientY - rect.top) * scaleY
                );
            },

            handleTouchMove(e) {
                if (this.disabled || !this.isDrawing) return;

                const touch = e.touches[0];
                const rect = this.canvas.getBoundingClientRect();
                const scaleX = this.canvas.width / rect.width;
                const scaleY = this.canvas.height / rect.height;

                this.draw(
                    (touch.clientX - rect.left) * scaleX,
                    (touch.clientY - rect.top) * scaleY
                );
            },

            handleTouchEnd(e) {
                if (this.disabled) return;
                this.stopDrawing();
            },

            // Eventos de mouse
            handleMouseDown(e) {
                if (this.disabled) return;

                const rect = this.canvas.getBoundingClientRect();
                const scaleX = this.canvas.width / rect.width;
                const scaleY = this.canvas.height / rect.height;

                this.startDrawing(
                    (e.clientX - rect.left) * scaleX,
                    (e.clientY - rect.top) * scaleY
                );
            },

            handleMouseMove(e) {
                if (this.disabled || !this.isDrawing) return;

                const rect = this.canvas.getBoundingClientRect();
                const scaleX = this.canvas.width / rect.width;
                const scaleY = this.canvas.height / rect.height;

                this.draw(
                    (e.clientX - rect.left) * scaleX,
                    (e.clientY - rect.top) * scaleY
                );
            },

            handleMouseUp(e) {
                if (this.disabled) return;
                this.stopDrawing();
            },

            handleMouseLeave(e) {
                if (this.disabled) return;
                this.stopDrawing();
            },

            // Navegación por teclado
            handleKeyDown(e) {
                if (this.disabled) return;

                switch(e.key) {
                    case 'Delete':
                    case 'Backspace':
                        e.preventDefault();
                        this.clearSignature();
                        break;
                    case 'Enter':
                    case ' ':
                        e.preventDefault();
                        // Foco en el botón de limpiar
                        const clearButton = this.canvas.closest('[x-data]').querySelector('button');
                        if (clearButton) clearButton.focus();
                        break;
                }
            },

            // Iniciar dibujo
            startDrawing(x, y) {
                this.isDrawing = true;
                this.lastX = x;
                this.lastY = y;
                this.ctx.beginPath();
                this.ctx.moveTo(x, y);
                this.clearError();
            },

            // Dibujar
            draw(x, y) {
                if (!this.isDrawing) return;

                this.ctx.lineTo(x, y);
                this.ctx.stroke();

                this.lastX = x;
                this.lastY = y;
            },

            // Detener dibujo
            stopDrawing() {
                if (!this.isDrawing) return;

                this.isDrawing = false;
                this.ctx.beginPath();
                this.isSigned = true;
                this.updateSignatureData();
            },

            // Limpiar firma
            clearSignature() {
                this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                this.setupCanvas();
                this.isSigned = false;
                this.signatureData = '';
                this.clearError();

                // Foco en el canvas
                this.canvas.focus();
            },

            // Cargar firma existente
            loadSignature(dataUrl) {
                const img = new Image();
                img.onload = () => {
                    this.ctx.drawImage(img, 0, 0);
                    this.isSigned = true;
                    this.signatureData = dataUrl;
                };
                img.src = dataUrl;
            },

            // Actualizar datos de firma
            updateSignatureData() {
                if (!this.isSigned) {
                    this.signatureData = '';
                    return;
                }

                try {
                    this.signatureData = this.canvas.toDataURL('image/png');
                } catch (error) {
                    this.setError('Error al generar los datos de la firma');
                }
            },

            // Obtener información de la firma
            getSignatureInfo() {
                if (!this.isSigned) return 'Sin firmar';

                const dataSize = this.signatureData.length;
                const sizeKB = Math.round(dataSize / 1024);
                return `Firmado (${sizeKB}KB)`;
            },

            // Manejar errores
            setError(message) {
                this.hasError = true;
                this.errorMessage = message;
            },

            clearError() {
                this.hasError = false;
                this.errorMessage = '';
            },

            // Validar firma
            validate() {
                if (this.required && !this.isSigned) {
                    this.setError('La firma es requerida');
                    return false;
                }

                this.clearError();
                return true;
            }
        };
    }
</script>

{{-- CDN para SignaturePad (opcional para funcionalidad avanzada) --}}
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
@endpush

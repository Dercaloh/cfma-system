{{-- resources/views/components/interaction/photo-capture.blade.php --}}
@props([
    'name' => 'photo',
    'label' => 'Capturar foto',
    'description' => null,
    'required' => false,
    'maxSize' => '5MB',
    'quality' => 0.8,
    'width' => 640,
    'height' => 480,
    'facingMode' => 'environment', // user, environment
    'showPreview' => true,
    'allowRetake' => true,
    'allowUpload' => true,
    'acceptedFormats' => 'image/*',
    'class' => '',
    'id' => null
])

@php
    $id = $id ?? 'photo-capture-' . uniqid();
    $inputId = $id . '-input';
    $videoId = $id . '-video';
    $canvasId = $id . '-canvas';
    $previewId = $id . '-preview';
@endphp

<div {{ $attributes->merge(['class' => 'w-full max-w-md mx-auto ' . $class]) }}>
    <!-- Label -->
    @if($label)
        <label for="{{ $inputId }}" class="block mb-2 text-sm font-semibold text-sena-gris-700">
            {{ $label }}
            @if($required)
                <span class="ml-1 text-red-500" aria-label="Campo requerido">*</span>
            @endif
        </label>
    @endif

    <!-- Description -->
    @if($description)
        <p class="mb-3 text-sm text-sena-gris-600">{{ $description }}</p>
    @endif

    <!-- Input oculto para el archivo -->
    <input
        type="hidden"
        name="{{ $name }}"
        id="{{ $inputId }}"
        data-photo-input
        {{ $required ? 'required' : '' }}
    >

    <!-- Contenedor principal -->
    <div class="p-6 space-y-4 glass-card rounded-xl">
        <!-- Botones de acción -->
        <div class="flex flex-wrap justify-center gap-3">
            <button
                type="button"
                id="{{ $id }}-capture-btn"
                class="inline-flex items-center px-4 py-2 space-x-2 rounded-lg btn-sena"
                onclick="startCamera('{{ $id }}')"
                aria-describedby="{{ $id }}-capture-help"
            >
                <x-heroicon-o-camera class="w-5 h-5" />
                <span>Capturar foto</span>
            </button>

            @if($allowUpload)
                <button
                    type="button"
                    id="{{ $id }}-upload-btn"
                    class="inline-flex items-center px-4 py-2 space-x-2 rounded-lg btn-secondary"
                    onclick="uploadPhoto('{{ $id }}')"
                    aria-describedby="{{ $id }}-upload-help"
                >
                    <x-heroicon-o-photo class="w-5 h-5" />
                    <span>Subir foto</span>
                </button>
            @endif
        </div>

        <!-- Input file oculto -->
        <input
            type="file"
            id="{{ $id }}-file-input"
            accept="{{ $acceptedFormats }}"
            class="hidden"
            onchange="handleFileUpload(event, '{{ $id }}')"
        >

        <!-- Área de cámara -->
        <div id="{{ $id }}-camera-container" class="hidden">
            <div class="relative overflow-hidden bg-black rounded-lg">
                <video
                    id="{{ $videoId }}"
                    class="object-cover w-full h-auto max-h-64"
                    playsinline
                    muted
                    aria-label="Vista previa de la cámara"
                ></video>

                <!-- Overlay con guías -->
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute border-2 border-white border-dashed rounded-lg opacity-50 inset-4"></div>
                    <div class="absolute px-2 py-1 text-xs text-white bg-black bg-opacity-50 rounded top-2 left-2">
                        Centrar objeto en el marco
                    </div>
                </div>
            </div>

            <!-- Controles de cámara -->
            <div class="flex justify-center mt-4 space-x-4">
                <button
                    type="button"
                    id="{{ $id }}-take-photo-btn"
                    class="px-6 py-2 rounded-lg btn-sena"
                    onclick="takePhoto('{{ $id }}')"
                >
                    <x-heroicon-o-camera class="w-5 h-5 mr-2" />
                    Tomar foto
                </button>

                <button
                    type="button"
                    id="{{ $id }}-cancel-btn"
                    class="px-6 py-2 rounded-lg btn-secondary"
                    onclick="stopCamera('{{ $id }}')"
                >
                    <x-heroicon-o-x-mark class="w-5 h-5 mr-2" />
                    Cancelar
                </button>
            </div>
        </div>

        <!-- Canvas oculto para procesamiento -->
        <canvas id="{{ $canvasId }}" class="hidden"></canvas>

        <!-- Área de preview -->
        @if($showPreview)
            <div id="{{ $id }}-preview-container" class="hidden">
                <div class="relative">
                    <img
                        id="{{ $previewId }}"
                        class="object-cover w-full h-auto border-2 rounded-lg max-h-64 border-sena-gris-200"
                        alt="Vista previa de la foto capturada"
                    >

                    <!-- Información de la foto -->
                    <div id="{{ $id }}-photo-info" class="mt-2 text-xs text-sena-gris-600"></div>
                </div>

                @if($allowRetake)
                    <div class="flex justify-center mt-4 space-x-4">
                        <button
                            type="button"
                            class="px-4 py-2 rounded-lg btn-secondary"
                            onclick="retakePhoto('{{ $id }}')"
                        >
                            <x-heroicon-o-arrow-path class="w-4 h-4 mr-2" />
                            Tomar otra
                        </button>

                        <button
                            type="button"
                            class="px-4 py-2 rounded-lg btn-sena"
                            onclick="confirmPhoto('{{ $id }}')"
                        >
                            <x-heroicon-o-check class="w-4 h-4 mr-2" />
                            Confirmar
                        </button>
                    </div>
                @endif
            </div>
        @endif

        <!-- Estados de carga -->
        <div id="{{ $id }}-loading" class="hidden py-8 text-center">
            <div class="w-8 h-8 mx-auto border-b-2 rounded-full animate-spin border-sena-verde"></div>
            <p class="mt-2 text-sm text-sena-gris-600">Procesando imagen...</p>
        </div>

        <!-- Mensajes de error -->
        <div id="{{ $id }}-error" class="hidden p-4 border border-red-200 rounded-lg bg-red-50">
            <div class="flex items-center">
                <x-heroicon-o-exclamation-triangle class="w-5 h-5 mr-2 text-red-400" />
                <span id="{{ $id }}-error-message" class="text-sm text-red-700"></span>
            </div>
        </div>
    </div>

    <!-- Ayuda contextual -->
    <div class="mt-2 space-y-1 text-xs text-sena-gris-500">
        <p id="{{ $id }}-capture-help">Presiona "Capturar foto" para usar la cámara del dispositivo</p>
        @if($allowUpload)
            <p id="{{ $id }}-upload-help">O selecciona una imagen desde tu dispositivo</p>
        @endif
        <p>Tamaño máximo: {{ $maxSize }}</p>
    </div>
</div>

<script>
    // Variables globales para cada instancia
    const photoCapture = {
        streams: new Map(),
        photos: new Map()
    };

    // Iniciar cámara
    async function startCamera(componentId) {
        try {
            showLoading(componentId);
            hideError(componentId);

            const constraints = {
                video: {
                    width: {{ $width }},
                    height: {{ $height }},
                    facingMode: '{{ $facingMode }}'
                }
            };

            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            const video = document.getElementById(componentId + '-video');

            video.srcObject = stream;
            video.play();

            // Guardar stream para poder cerrarlo después
            photoCapture.streams.set(componentId, stream);

            // Mostrar interfaz de cámara
            document.getElementById(componentId + '-camera-container').classList.remove('hidden');
            document.getElementById(componentId + '-capture-btn').classList.add('hidden');
            document.getElementById(componentId + '-upload-btn')?.classList.add('hidden');

            hideLoading(componentId);

        } catch (error) {
            console.error('Error al acceder a la cámara:', error);
            showError(componentId, 'No se pudo acceder a la cámara. Verifica los permisos.');
            hideLoading(componentId);
        }
    }

    // Detener cámara
    function stopCamera(componentId) {
        const stream = photoCapture.streams.get(componentId);
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            photoCapture.streams.delete(componentId);
        }

        // Ocultar interfaz de cámara
        document.getElementById(componentId + '-camera-container').classList.add('hidden');
        document.getElementById(componentId + '-capture-btn').classList.remove('hidden');
        document.getElementById(componentId + '-upload-btn')?.classList.remove('hidden');
    }

    // Tomar foto
    function takePhoto(componentId) {
        const video = document.getElementById(componentId + '-video');
        const canvas = document.getElementById(componentId + '-canvas');
        const context = canvas.getContext('2d');

        // Configurar canvas
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        // Dibujar frame actual del video
        context.drawImage(video, 0, 0);

        // Convertir a blob
        canvas.toBlob((blob) => {
            processPhoto(componentId, blob);
        }, 'image/jpeg', {{ $quality }});
    }

    // Subir foto desde archivo
    function uploadPhoto(componentId) {
        const fileInput = document.getElementById(componentId + '-file-input');
        fileInput.click();
    }

    // Manejar archivo subido
    function handleFileUpload(event, componentId) {
        const file = event.target.files[0];
        if (file) {
            // Validar tamaño
            const maxSizeBytes = parseFileSize('{{ $maxSize }}');
            if (file.size > maxSizeBytes) {
                showError(componentId, `El archivo es demasiado grande. Máximo: {{ $maxSize }}`);
                return;
            }

            // Validar tipo
            if (!file.type.startsWith('image/')) {
                showError(componentId, 'Solo se permiten archivos de imagen');
                return;
            }

            processPhoto(componentId, file);
        }
    }

    // Procesar foto (común para cámara y archivo)
    function processPhoto(componentId, blob) {
        showLoading(componentId);

        const reader = new FileReader();
        reader.onload = function(e) {
            const dataUrl = e.target.result;

            // Mostrar preview
            const preview = document.getElementById(componentId + '-preview');
            preview.src = dataUrl;

            // Mostrar información
            const info = document.getElementById(componentId + '-photo-info');
            info.innerHTML = `
                Tamaño: ${formatFileSize(blob.size)} |
                Tipo: ${blob.type} |
                Fecha: ${new Date().toLocaleString()}
            `;

            // Guardar datos
            photoCapture.photos.set(componentId, {
                blob: blob,
                dataUrl: dataUrl,
                timestamp: new Date().toISOString()
            });

            // Mostrar preview
            document.getElementById(componentId + '-preview-container').classList.remove('hidden');

            // Ocultar cámara si está activa
            stopCamera(componentId);

            hideLoading(componentId);
        };

        reader.readAsDataURL(blob);
    }

    // Retomar foto
    function retakePhoto(componentId) {
        document.getElementById(componentId + '-preview-container').classList.add('hidden');
        document.getElementById(componentId + '-capture-btn').classList.remove('hidden');
        document.getElementById(componentId + '-upload-btn')?.classList.remove('hidden');

        // Limpiar datos
        photoCapture.photos.delete(componentId);
        updateHiddenInput(componentId, null);
    }

    // Confirmar foto
    function confirmPhoto(componentId) {
        const photoData = photoCapture.photos.get(componentId);
        if (photoData) {
            updateHiddenInput(componentId, photoData.dataUrl);

            // Disparar evento personalizado
            const event = new CustomEvent('photoConfirmed', {
                detail: {
                    componentId: componentId,
                    photoData: photoData
                }
            });
            document.dispatchEvent(event);
        }
    }

    // Actualizar input oculto
    function updateHiddenInput(componentId, value) {
        const input = document.getElementById(componentId + '-input');
        input.value = value || '';

        // Disparar evento change
        input.dispatchEvent(new Event('change'));
    }

    // Funciones de utilidad
    function showLoading(componentId) {
        document.getElementById(componentId + '-loading').classList.remove('hidden');
    }

    function hideLoading(componentId) {
        document.getElementById(componentId + '-loading').classList.add('hidden');
    }

    function showError(componentId, message) {
        const errorDiv = document.getElementById(componentId + '-error');
        const errorMessage = document.getElementById(componentId + '-error-message');

        errorMessage.textContent = message;
        errorDiv.classList.remove('hidden');

        // Auto-ocultar después de 5 segundos
        setTimeout(() => hideError(componentId), 5000);
    }

    function hideError(componentId) {
        document.getElementById(componentId + '-error').classList.add('hidden');
    }

    function parseFileSize(sizeStr) {
        const units = { B: 1, KB: 1024, MB: 1024*1024, GB: 1024*1024*1024 };
        const match = sizeStr.match(/^(\d+(?:\.\d+)?)\s*([A-Z]+)$/i);
        if (match) {
            const value = parseFloat(match[1]);
            const unit = match[2].toUpperCase();
            return value * (units[unit] || 1);
        }
        return parseInt(sizeStr) || 0;
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Limpiar recursos al salir
    window.addEventListener('beforeunload', function() {
        photoCapture.streams.forEach(stream => {
            stream.getTracks().forEach(track => track.stop());
        });
    });
</script>

<style>
    /* Estilos adicionales para la cámara */
    #{{ $videoId }} {
        transform: scaleX(-1); /* Efecto espejo para cámara frontal */
    }

    /* Animaciones */
    .glass-card {
        transition: all 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(57, 169, 0, 0.1);
    }

    /* Botones de acción */
    .btn-sena {
        background: linear-gradient(135deg, #39A900, #2d8f00);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-sena:hover {
        background: linear-gradient(135deg, #2d8f00, #39A900);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 640px) {
        .glass-card {
            padding: 1rem;
        }

        #{{ $videoId }} {
            max-height: 200px;
        }
    }
</style>

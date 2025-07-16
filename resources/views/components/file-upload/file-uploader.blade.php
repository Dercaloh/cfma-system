{{-- resources/views/components/file-upload/file-uploader.blade.php --}}
@props([
    'name' => 'files',
    'label' => 'Subir archivos',
    'accept' => '*',
    'maxSize' => '5MB',
    'multiple' => false,
    'required' => false,
    'description' => null,
    'value' => null,
    'showProgress' => true,
    'showPreview' => true,
    'maxFiles' => 10
])

@php
    $uuid = str_replace('-', '', \Illuminate\Support\Str::uuid());
    $acceptedTypes = $accept === '*' ? '*' : explode(',', $accept);
    $maxSizeBytes = $maxSize ? (int)filter_var($maxSize, FILTER_SANITIZE_NUMBER_INT) * 1024 * 1024 : 5242880;
    $isMultiple = $multiple === true || $multiple === 'true';
    $isRequired = $required === true || $required === 'true';
@endphp

<div class="file-uploader-container" x-data="fileUploader({
    name: '{{ $name }}',
    maxSize: {{ $maxSizeBytes }},
    multiple: {{ $isMultiple ? 'true' : 'false' }},
    accept: @json($acceptedTypes),
    maxFiles: {{ $maxFiles }},
    existingFiles: @json($value ?? [])
})" x-init="initUploader()">

    {{-- Label --}}
    @if($label)
        <label for="{{ $name }}_{{ $uuid }}" class="block mb-3 text-sm font-semibold text-sena-azul-900">
            {{ $label }}
            @if($isRequired)
                <span class="ml-1 text-red-500" aria-label="Campo requerido">*</span>
            @endif
        </label>
    @endif

    {{-- Descripción --}}
    @if($description)
        <p class="mb-4 text-sm text-sena-gris-600">{{ $description }}</p>
    @endif

    {{-- Zona de Drop --}}
    <div class="p-6 transition-all duration-300 border-2 border-dashed glass-card"
         :class="isDragOver ? 'border-sena-verde bg-sena-verde/5' : 'border-sena-gris-300 hover:border-sena-verde/50'"
         @dragover.prevent="isDragOver = true"
         @dragleave.prevent="isDragOver = false"
         @drop.prevent="handleDrop($event)">

        {{-- Upload Area --}}
        <div class="text-center">
            <svg class="w-12 h-12 mx-auto mb-4 text-sena-gris-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>

            <div class="mb-2 text-sena-azul-700">
                <button type="button"
                        @click="$refs.fileInput.click()"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium btn-sena">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Seleccionar archivo{{ $isMultiple ? 's' : '' }}
                </button>
                <span class="ml-2">o arrastra y suelta aquí</span>
            </div>

            <p class="text-xs text-sena-gris-500">
                @if($accept !== '*')
                    Tipos permitidos: {{ str_replace(',', ', ', $accept) }} •
                @endif
                Tamaño máximo: {{ $maxSize }}
                @if($isMultiple)
                    • Máximo {{ $maxFiles }} archivos
                @endif
            </p>
        </div>

        {{-- Input File Oculto --}}
        <input type="file"
               x-ref="fileInput"
               id="{{ $name }}_{{ $uuid }}"
               name="{{ $name }}{{ $isMultiple ? '[]' : '' }}"
               class="hidden"
               @if($isMultiple) multiple @endif
               @if($accept !== '*') accept="{{ $accept }}" @endif
               @if($isRequired) required @endif
               @change="handleFileSelect($event)"
               aria-describedby="{{ $name }}_{{ $uuid }}_help">
    </div>

    {{-- Progreso Global --}}
    <div x-show="showProgress && totalProgress > 0"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-y-0"
         x-transition:enter-end="opacity-100 transform scale-y-100"
         class="mt-4">
        <div class="flex items-center justify-between mb-2 text-sm text-sena-gris-600">
            <span>Progreso general</span>
            <span x-text="Math.round(totalProgress) + '%'"></span>
        </div>
        <div class="w-full h-2 rounded-full bg-sena-gris-200">
            <div class="h-2 transition-all duration-300 rounded-full bg-sena-verde"
                 :style="'width: ' + totalProgress + '%'"></div>
        </div>
    </div>

    {{-- Lista de Archivos --}}
    <div x-show="files.length > 0"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="mt-6 space-y-3">

        <h4 class="text-sm font-medium text-sena-azul-900">
            Archivos seleccionados (<span x-text="files.length"></span>)
        </h4>

        <template x-for="(file, index) in files" :key="file.id">
            <div class="p-4 border glass-card border-sena-gris-200">
                <div class="flex items-center justify-between">
                    {{-- Información del archivo --}}
                    <div class="flex items-center flex-1 min-w-0">
                        {{-- Icono --}}
                        <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-lg"
                             :class="getFileIconClass(file.type)">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path x-show="file.type.startsWith('image/')" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                                <path x-show="file.type === 'application/pdf'" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-5L9 2H4z"/>
                                <path x-show="!file.type.startsWith('image/') && file.type !== 'application/pdf'" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z M4 5a2 2 0 012-2v0a2 2 0 012 2v6.5a.5.5 0 01-.5.5h-3a.5.5 0 01-.5-.5V5z"/>
                            </svg>
                        </div>

                        {{-- Detalles --}}
                        <div class="flex-1 min-w-0 ml-4">
                            <p class="text-sm font-medium truncate text-sena-azul-900" x-text="file.name"></p>
                            <p class="text-xs text-sena-gris-500">
                                <span x-text="formatFileSize(file.size)"></span>
                                <span x-show="file.lastModified"> • </span>
                                <span x-text="formatDate(file.lastModified)"></span>
                            </p>

                            {{-- Progreso individual --}}
                            <div x-show="file.progress !== undefined && file.progress < 100" class="mt-2">
                                <div class="w-full h-1 rounded-full bg-sena-gris-200">
                                    <div class="h-1 transition-all duration-300 rounded-full bg-sena-verde"
                                         :style="'width: ' + file.progress + '%'"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Acciones --}}
                    <div class="flex items-center ml-4 space-x-2">
                        {{-- Vista previa --}}
                        <button type="button"
                                x-show="file.type.startsWith('image/') || file.type === 'application/pdf'"
                                @click="previewFile(file)"
                                class="p-2 transition-colors rounded-lg text-sena-gris-400 hover:text-sena-verde hover:bg-sena-gris-100"
                                title="Vista previa">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>

                        {{-- Eliminar --}}
                        <button type="button"
                                @click="removeFile(index)"
                                class="p-2 transition-colors rounded-lg text-sena-gris-400 hover:text-red-500 hover:bg-red-50"
                                title="Eliminar archivo">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- Mensajes de Error --}}
    <div x-show="errors.length > 0"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="mt-4">
        <div class="p-4 border border-red-200 rounded-lg bg-red-50">
            <div class="flex">
                <svg class="flex-shrink-0 w-5 h-5 mr-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1">
                    <h4 class="mb-1 text-sm font-medium text-red-800">Error en archivos:</h4>
                    <ul class="space-y-1 text-sm text-red-700">
                        <template x-for="error in errors" :key="error">
                            <li x-text="error"></li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal de Vista Previa --}}
<div x-show="showPreview"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
     @click="showPreview = false"
     @keydown.escape="showPreview = false">

    <div class="bg-white rounded-xl max-w-4xl max-h-[90vh] overflow-hidden shadow-2xl"
         @click.stop>

        {{-- Header --}}
        <div class="flex items-center justify-between p-4 border-b border-sena-gris-200">
            <h3 class="text-lg font-semibold text-sena-azul-900" x-text="previewFile?.name || 'Vista previa'"></h3>
            <button @click="showPreview = false"
                    class="p-2 transition-colors rounded-lg text-sena-gris-400 hover:text-sena-gris-600 hover:bg-sena-gris-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Contenido --}}
        <div class="p-4 overflow-auto max-h-[calc(90vh-120px)]">
            <div x-show="previewFile?.type?.startsWith('image/')" class="text-center">
                <img :src="previewFile?.url"
                     :alt="previewFile?.name"
                     class="max-w-full max-h-full rounded-lg shadow-lg">
            </div>

            <div x-show="previewFile?.type === 'application/pdf'" class="text-center">
                <embed :src="previewFile?.url"
                       type="application/pdf"
                       class="w-full rounded-lg h-96">
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('fileUploader', (config) => ({
        files: [],
        errors: [],
        isDragOver: false,
        showPreview: false,
        previewFile: null,
        totalProgress: 0,
        showProgress: config.showProgress ?? true,

        initUploader() {
            // Inicializar con archivos existentes si los hay
            if (config.existingFiles && config.existingFiles.length > 0) {
                this.files = config.existingFiles.map(file => ({
                    id: Date.now() + Math.random(),
                    name: file.name,
                    size: file.size,
                    type: file.type,
                    url: file.url,
                    progress: 100
                }));
            }
        },

        handleDrop(event) {
            this.isDragOver = false;
            const files = Array.from(event.dataTransfer.files);
            this.processFiles(files);
        },

        handleFileSelect(event) {
            const files = Array.from(event.target.files);
            this.processFiles(files);
        },

        processFiles(newFiles) {
            this.errors = [];

            // Validar cantidad de archivos
            if (!config.multiple && newFiles.length > 1) {
                this.errors.push('Solo se permite un archivo');
                return;
            }

            if (config.multiple && (this.files.length + newFiles.length) > config.maxFiles) {
                this.errors.push(`Máximo ${config.maxFiles} archivos permitidos`);
                return;
            }

            // Procesar cada archivo
            newFiles.forEach(file => {
                if (this.validateFile(file)) {
                    this.addFile(file);
                }
            });
        },

        validateFile(file) {
            // Validar tamaño
            if (file.size > config.maxSize) {
                this.errors.push(`${file.name}: Archivo demasiado grande (máximo ${this.formatFileSize(config.maxSize)})`);
                return false;
            }

            // Validar tipo
            if (config.accept !== '*' && !this.isFileTypeAllowed(file.type)) {
                this.errors.push(`${file.name}: Tipo de archivo no permitido`);
                return false;
            }

            return true;
        },

        isFileTypeAllowed(fileType) {
            if (config.accept.includes('*')) return true;

            return config.accept.some(allowedType => {
                if (allowedType.includes('*')) {
                    const baseType = allowedType.split('/')[0];
                    return fileType.startsWith(baseType);
                }
                return fileType === allowedType;
            });
        },

        addFile(file) {
            const fileObj = {
                id: Date.now() + Math.random(),
                name: file.name,
                size: file.size,
                type: file.type,
                lastModified: file.lastModified,
                file: file,
                progress: 0,
                url: URL.createObjectURL(file)
            };

            if (config.multiple) {
                this.files.push(fileObj);
            } else {
                this.files = [fileObj];
            }

            this.simulateUpload(fileObj);
        },

        simulateUpload(fileObj) {
            // Simulación de progreso de subida
            const interval = setInterval(() => {
                fileObj.progress += Math.random() * 30;
                if (fileObj.progress >= 100) {
                    fileObj.progress = 100;
                    clearInterval(interval);
                }
                this.updateTotalProgress();
            }, 200);
        },

        updateTotalProgress() {
            if (this.files.length === 0) {
                this.totalProgress = 0;
                return;
            }

            const totalProgress = this.files.reduce((sum, file) => sum + (file.progress || 0), 0);
            this.totalProgress = totalProgress / this.files.length;
        },

        removeFile(index) {
            const file = this.files[index];
            if (file.url) {
                URL.revokeObjectURL(file.url);
            }
            this.files.splice(index, 1);
            this.updateTotalProgress();
        },

        previewFile(file) {
            this.previewFile = file;
            this.showPreview = true;
        },

        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },

        formatDate(timestamp) {
            if (!timestamp) return '';
            return new Date(timestamp).toLocaleDateString('es-CO', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        },

        getFileIconClass(fileType) {
            if (fileType.startsWith('image/')) {
                return 'bg-blue-100 text-blue-600';
            } else if (fileType === 'application/pdf') {
                return 'bg-red-100 text-red-600';
            } else {
                return 'bg-sena-gris-100 text-sena-gris-600';
            }
        }
    }));
});
</script>

<style>
.file-uploader-container {
    @apply w-full;
}

.glass-card {
    @apply backdrop-blur-sm bg-white/90 border border-sena-gris-200/50 rounded-xl shadow-lg;
}

.btn-sena {
    @apply bg-sena-verde hover:bg-sena-verde-sec text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 shadow-neumorph hover:shadow-neumorph-hover;
}

.sena-focus {
    @apply focus:ring-2 focus:ring-sena-verde focus:border-sena-verde;
}
</style>

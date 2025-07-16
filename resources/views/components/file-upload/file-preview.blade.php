{{-- resources/views/components/file-upload/file-preview.blade.php --}}
@props([
    'file' => null,
    'showDelete' => true,
    'showDownload' => true,
    'index' => null,
    'size' => 'md' // sm, md, lg
])

@php
    $sizeClasses = [
        'sm' => 'w-16 h-16',
        'md' => 'w-24 h-24',
        'lg' => 'w-32 h-32'
    ];

    $currentSize = $sizeClasses[$size] ?? $sizeClasses['md'];

    if ($file) {
        $fileName = is_string($file) ? basename($file) : ($file->getClientOriginalName() ?? 'archivo');
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileSize = is_string($file) ? 0 : $file->getSize();
        $filePath = is_string($file) ? $file : null;

        $isImage = in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
        $isPdf = $fileExtension === 'pdf';
        $isDocument = in_array($fileExtension, ['doc', 'docx', 'txt', 'rtf']);
        $isExcel = in_array($fileExtension, ['xls', 'xlsx', 'csv']);
        $isVideo = in_array($fileExtension, ['mp4', 'avi', 'mov', 'wmv']);
        $isAudio = in_array($fileExtension, ['mp3', 'wav', 'ogg', 'flac']);
    }
@endphp

@if($file)
<div class="relative p-3 transition-all duration-300 bg-white border rounded-lg file-preview-item group border-sena-gris-300 shadow-neumorph hover:shadow-neumorph-hover"
     data-file-index="{{ $index }}"
     role="article"
     aria-label="Vista previa del archivo {{ $fileName }}">

    {{-- Contenedor principal del preview --}}
    <div class="flex items-start space-x-3">

        {{-- Icono/Imagen de preview --}}
        <div class="flex-shrink-0 {{ $currentSize }} relative">
            @if($isImage && $filePath)
                <img src="{{ asset('storage/' . $filePath) }}"
                     alt="Vista previa de {{ $fileName }}"
                     class="object-cover w-full h-full border rounded-lg border-sena-gris-200"
                     loading="lazy">
            @elseif($isImage && !$filePath)
                <div class="flex items-center justify-center w-full h-full border rounded-lg bg-sena-gris-100 border-sena-gris-200">
                    <x-heroicon-o-photo class="w-6 h-6 text-sena-gris-500" />
                </div>
            @elseif($isPdf)
                <div class="flex items-center justify-center w-full h-full border border-red-200 rounded-lg bg-red-50">
                    <x-heroicon-o-document-text class="w-6 h-6 text-red-600" />
                </div>
            @elseif($isDocument)
                <div class="flex items-center justify-center w-full h-full border border-blue-200 rounded-lg bg-blue-50">
                    <x-heroicon-o-document class="w-6 h-6 text-blue-600" />
                </div>
            @elseif($isExcel)
                <div class="flex items-center justify-center w-full h-full border border-green-200 rounded-lg bg-green-50">
                    <x-heroicon-o-table-cells class="w-6 h-6 text-green-600" />
                </div>
            @elseif($isVideo)
                <div class="flex items-center justify-center w-full h-full border border-purple-200 rounded-lg bg-purple-50">
                    <x-heroicon-o-video-camera class="w-6 h-6 text-purple-600" />
                </div>
            @elseif($isAudio)
                <div class="flex items-center justify-center w-full h-full border border-yellow-200 rounded-lg bg-yellow-50">
                    <x-heroicon-o-musical-note class="w-6 h-6 text-yellow-600" />
                </div>
            @else
                <div class="flex items-center justify-center w-full h-full border rounded-lg bg-sena-gris-100 border-sena-gris-200">
                    <x-heroicon-o-document class="w-6 h-6 text-sena-gris-500" />
                </div>
            @endif

            {{-- Indicador de estado de carga --}}
            <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-200 rounded-lg opacity-0 bg-white/80 group-hover:opacity-100">
                <div class="text-xs font-medium text-sena-gris-600">
                    {{ strtoupper($fileExtension) }}
                </div>
            </div>
        </div>

        {{-- Información del archivo --}}
        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium truncate text-sena-gris-900" title="{{ $fileName }}">
                        {{ $fileName }}
                    </h4>
                    <p class="mt-1 text-xs text-sena-gris-500">
                        @if($fileSize > 0)
                            {{ number_format($fileSize / 1024, 1) }} KB
                        @endif
                        @if($fileSize > 0 && $fileExtension)
                            •
                        @endif
                        @if($fileExtension)
                            {{ strtoupper($fileExtension) }}
                        @endif
                    </p>
                </div>

                {{-- Botones de acción --}}
                <div class="flex items-center ml-2 space-x-1">
                    @if($showDownload && $filePath)
                        <button type="button"
                                onclick="downloadFile('{{ asset('storage/' . $filePath) }}', '{{ $fileName }}')"
                                class="p-1 transition-colors duration-200 rounded text-sena-gris-400 hover:text-sena-verde-600 focus:outline-none focus:ring-2 focus:ring-sena-verde-500"
                                title="Descargar archivo"
                                aria-label="Descargar {{ $fileName }}">
                            <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
                        </button>
                    @endif

                    @if($showDelete)
                        <button type="button"
                                onclick="removeFile({{ $index }})"
                                class="p-1 transition-colors duration-200 rounded text-sena-gris-400 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                                title="Eliminar archivo"
                                aria-label="Eliminar {{ $fileName }}">
                            <x-heroicon-o-x-mark class="w-4 h-4" />
                        </button>
                    @endif
                </div>
            </div>

            {{-- Barra de progreso (si está subiendo) --}}
            <div class="hidden mt-2" data-progress-container>
                <div class="w-full bg-sena-gris-200 rounded-full h-1.5">
                    <div class="bg-sena-verde-600 h-1.5 rounded-full transition-all duration-300"
                         style="width: 0%"
                         data-progress-bar></div>
                </div>
                <div class="mt-1 text-xs text-sena-gris-500" data-progress-text>
                    Subiendo...
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function downloadFile(url, filename) {
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function removeFile(index) {
    if (confirm('¿Estás seguro de que deseas eliminar este archivo?')) {
        const fileItem = document.querySelector(`[data-file-index="${index}"]`);
        if (fileItem) {
            fileItem.remove();

            // Disparar evento personalizado para notificar al componente padre
            window.dispatchEvent(new CustomEvent('file-removed', {
                detail: { index: index }
            }));
        }
    }
}

// Función para actualizar el progreso de subida
function updateFileProgress(index, progress) {
    const fileItem = document.querySelector(`[data-file-index="${index}"]`);
    if (fileItem) {
        const progressContainer = fileItem.querySelector('[data-progress-container]');
        const progressBar = fileItem.querySelector('[data-progress-bar]');
        const progressText = fileItem.querySelector('[data-progress-text]');

        if (progressContainer && progressBar && progressText) {
            if (progress >= 0 && progress <= 100) {
                progressContainer.classList.remove('hidden');
                progressBar.style.width = progress + '%';
                progressText.textContent = `Subiendo... ${progress}%`;

                if (progress === 100) {
                    setTimeout(() => {
                        progressContainer.classList.add('hidden');
                    }, 1000);
                }
            }
        }
    }
}
</script>
@endif

{{-- resources/views/components/file-upload/file-progress.blade.php --}}
@props([
    'filename' => '',
    'progress' => 0,
    'status' => 'uploading', // uploading, success, error, processing
    'size' => null,
    'speed' => null,
    'timeRemaining' => null,
    'showCancel' => true,
    'id' => null
])

@php
    $statusConfig = [
        'uploading' => [
            'color' => 'sena-verde',
            'icon' => 'arrow-up-tray',
            'text' => 'Subiendo...'
        ],
        'processing' => [
            'color' => 'sena-azul',
            'icon' => 'cog-6-tooth',
            'text' => 'Procesando...'
        ],
        'success' => [
            'color' => 'green',
            'icon' => 'check-circle',
            'text' => 'Completado'
        ],
        'error' => [
            'color' => 'red',
            'icon' => 'x-circle',
            'text' => 'Error'
        ]
    ];

    $currentStatus = $statusConfig[$status] ?? $statusConfig['uploading'];
    $progressPercentage = max(0, min(100, $progress));
@endphp

<div class="p-4 mb-3 transition-all duration-300 bg-white border rounded-lg file-progress-item border-sena-gris-300 shadow-neumorph"
     data-progress-id="{{ $id }}"
     role="progressbar"
     aria-valuenow="{{ $progressPercentage }}"
     aria-valuemin="0"
     aria-valuemax="100"
     aria-label="Progreso de subida: {{ $filename }}">

    {{-- Header con información del archivo --}}
    <div class="flex items-center justify-between mb-3">
        <div class="flex items-center flex-1 min-w-0 space-x-3">
            {{-- Icono de estado --}}
            <div class="flex-shrink-0">
                @if($status === 'uploading')
                    <div class="w-5 h-5 border-2 border-{{ $currentStatus['color'] }}-600 border-t-transparent rounded-full animate-spin"></div>
                @elseif($status === 'processing')
                    <x-heroicon-o-cog-6-tooth class="w-5 h-5 text-{{ $currentStatus['color'] }}-600 animate-spin" />
                @elseif($status === 'success')
                    <x-heroicon-s-check-circle class="w-5 h-5 text-{{ $currentStatus['color'] }}-600" />
                @elseif($status === 'error')
                    <x-heroicon-s-x-circle class="w-5 h-5 text-{{ $currentStatus['color'] }}-600" />
                @endif
            </div>

            {{-- Información del archivo --}}
            <div class="flex-1 min-w-0">
                <h4 class="text-sm font-medium truncate text-sena-gris-900" title="{{ $filename }}">
                    {{ $filename }}
                </h4>
                <div class="flex items-center mt-1 space-x-2 text-xs text-sena-gris-500">
                    <span>{{ $currentStatus['text'] }}</span>
                    @if($size)
                        <span>•</span>
                        <span>{{ $size }}</span>
                    @endif
                    @if($speed && $status === 'uploading')
                        <span>•</span>
                        <span>{{ $speed }}</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Porcentaje y botón cancelar --}}
        <div class="flex items-center ml-3 space-x-3">
            @if($status === 'uploading' || $status === 'processing')
                <span class="text-sm font-medium text-sena-gris-700">
                    {{ $progressPercentage }}%
                </span>
            @endif

            @if($showCancel && ($status === 'uploading' || $status === 'processing'))
                <button type="button"
                        onclick="cancelUpload('{{ $id }}')"
                        class="p-1 transition-colors duration-200 rounded text-sena-gris-400 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                        title="Cancelar subida"
                        aria-label="Cancelar subida de {{ $filename }}">
                    <x-heroicon-o-x-mark class="w-4 h-4" />
                </button>
            @endif
        </div>
    </div>

    {{-- Barra de progreso --}}
    <div class="w-full h-2 mb-2 rounded-full bg-sena-gris-200">
        <div class="h-2 rounded-full transition-all duration-300 {{ $status === 'error' ? 'bg-red-500' : 'bg-' . $currentStatus['color'] . '-600' }}"
             style="width: {{ $progressPercentage }}%"></div>
    </div>

    {{-- Información adicional --}}
    <div class="flex items-center justify-between text-xs text-sena-gris-500">
        <div class="flex items-center space-x-3">
            @if($timeRemaining && $status === 'uploading')
                <span>Tiempo restante: {{ $timeRemaining }}</span>
            @endif

            @if($status === 'error')
                <span class="font-medium text-red-600">Error al subir el archivo</span>
            @elseif($status === 'success')
                <span class="font-medium text-green-600">Archivo subido exitosamente</span>
            @endif
        </div>

        {{-- Botón de reintentar para errores --}}
        @if($status === 'error')
            <button type="button"
                    onclick="retryUpload('{{ $id }}')"
                    class="px-2 py-1 font-medium rounded text-sena-verde-600 hover:text-sena-verde-700 focus:outline-none focus:ring-2 focus:ring-sena-verde-500"
                    title="Reintentar subida">
                Reintentar
            </button>
        @endif
    </div>
</div>

<script>
// Función para cancelar la subida
function cancelUpload(id) {
    if (confirm('¿Estás seguro de que deseas cancelar la subida?')) {
        const progressItem = document.querySelector(`[data-progress-id="${id}"]`);
        if (progressItem) {
            progressItem.remove();

            // Disparar evento personalizado para notificar al componente padre
            window.dispatchEvent(new CustomEvent('upload-cancelled', {
                detail: { id: id }
            }));
        }
    }
}

// Función para reintentar la subida
function retryUpload(id) {
    const progressItem = document.querySelector(`[data-progress-id="${id}"]`);
    if (progressItem) {
        // Resetear el estado visual
        updateProgressStatus(id, 'uploading', 0);

        // Disparar evento personalizado para notificar al componente padre
        window.dispatchEvent(new CustomEvent('upload-retry', {
            detail: { id: id }
        }));
    }
}

// Función para actualizar el estado del progreso
function updateProgressStatus(id, status, progress = 0, additionalData = {}) {
    const progressItem = document.querySelector(`[data-progress-id="${id}"]`);
    if (!progressItem) return;

    const progressBar = progressItem.querySelector('[style*="width"]');
    const percentageText = progressItem.querySelector('span:contains("%")');

    // Actualizar barra de progreso
    if (progressBar) {
        progressBar.style.width = `${progress}%`;
        progressBar.setAttribute('aria-valuenow', progress);

        // Cambiar color según estado
        progressBar.className = progressBar.className.replace(/bg-\w+-\d+/,
            status === 'error' ? 'bg-red-500' : 'bg-sena-verde-600');
    }

    // Actualizar porcentaje
    if (percentageText) {
        percentageText.textContent = `${progress}%`;
    }

    // Actualizar información adicional si se proporciona
    if (additionalData.speed) {
        const speedElement = progressItem.querySelector('[data-speed]');
        if (speedElement) {
            speedElement.textContent = additionalData.speed;
        }
    }

    if (additionalData.timeRemaining) {
        const timeElement = progressItem.querySelector('[data-time-remaining]');
        if (timeElement) {
            timeElement.textContent = `Tiempo restante: ${additionalData.timeRemaining}`;
        }
    }
}

// Función para eliminar el indicador de progreso
function removeProgressIndicator(id) {
    const progressItem = document.querySelector(`[data-progress-id="${id}"]`);
    if (progressItem) {
        progressItem.style.opacity = '0';
        setTimeout(() => {
            progressItem.remove();
        }, 300);
    }
}

// Función para formatear el tamaño de archivo
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Función para formatear la velocidad
function formatSpeed(bytesPerSecond) {
    return formatFileSize(bytesPerSecond) + '/s';
}

// Función para formatear el tiempo restante
function formatTimeRemaining(seconds) {
    if (seconds < 60) return `${Math.round(seconds)}s`;
    if (seconds < 3600) return `${Math.round(seconds / 60)}m`;
    return `${Math.round(seconds / 3600)}h`;
}
</script>

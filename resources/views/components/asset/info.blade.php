@props(['assetType'])

@php
    $count = $assetType->assets_count ?? 0;
@endphp

<div class="p-6 mb-8 border-l-4 rounded-r-lg border-amber-500 bg-amber-50">
    <div class="flex items-start gap-3">
        <svg class="w-5 h-5 text-amber-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <h3 class="font-semibold text-amber-900">Información del tipo de activo</h3>
            <div class="mt-2 space-y-1 text-sm text-amber-700">
                <p>• <strong>ID:</strong> {{ $assetType->id }}</p>
                <p>• <strong>Creado:</strong> {{ $assetType->created_at->format('d/m/Y H:i') }}</p>
                <p>• <strong>Última actualización:</strong> {{ $assetType->updated_at->format('d/m/Y H:i') }}</p>
                @if ($count > 0)
                    <p>• <strong>Activos asociados:</strong> {{ $count }} activo(s)</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- resources/views/prestamos/show.blade.php --}}
<x-app-layout :header="__('Detalle del Préstamo')">

    {{-- Sección General --}}
    <x-glass-card title="Resumen del Préstamo">
        <ul class="space-y-2 text-base leading-6 text-gray-800">
            <li><strong>Solicitante:</strong> {{ $loan->user->name }}</li>
            <li><strong>Activo:</strong> {{ $loan->asset->name }}</li>
            <li><strong>Estado:</strong>
                <span class="px-2 py-1 rounded bg-sena-verde/10 text-sena-verde font-medium">
                    {{ ucfirst($loan->status->name) }}
                </span>
            </li>
            <li><strong>Solicitado:</strong> {{ $loan->requested_at->format('d/m/Y H:i') }}</li>
            @if($loan->approved_at)<li><strong>Aprobado:</strong> {{ $loan->approved_at->format('d/m/Y H:i') }}</li>@endif
            @if($loan->delivered_at)<li><strong>Entregado:</strong> {{ $loan->delivered_at->format('d/m/Y H:i') }}</li>@endif
            @if($loan->returned_at)<li><strong>Devuelto:</strong> {{ $loan->returned_at->format('d/m/Y H:i') }}</li>@endif
            <li><strong>Notas:</strong> {{ $loan->notes ?? '—' }}</li>
        </ul>
    </x-glass-card>

    {{-- Información Adicional --}}
    @if($loan->details)
        <x-glass-card title="Información adicional ({{ ucfirst($loan->details->tipo_de_uso) }})">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                <dt>Ficha:</dt><dd>{{ $loan->details->ficha ?? '—' }}</dd>
                <dt>Programa:</dt><dd>{{ $loan->details->programa ?? '—' }}</dd>
                <dt>Instructor:</dt><dd>{{ $loan->details->instructor ?? '—' }}</dd>
                <dt>Cargo:</dt><dd>{{ $loan->details->cargo ?? '—' }}</dd>
                <dt>Departamento:</dt><dd>{{ $loan->details->departamento ?? '—' }}</dd>
                <dt>Sede:</dt><dd>{{ $loan->details->sede }}</dd>
                <dt>Hora entrega:</dt><dd>{{ $loan->details->hora_entrega }}</dd>
                <dt>Cantidad:</dt><dd>{{ $loan->details->cantidad }}</dd>
                <dt>Propósito:</dt><dd>{{ $loan->details->proposito ?? '—' }}</dd>
            </dl>
        </x-glass-card>
    @endif

    {{-- Firmas --}}
    @if ($loan->signatures->isNotEmpty())
        <x-glass-card title="Firmas registradas">
            <div class="grid md:grid-cols-2 gap-4">
                @foreach ($loan->signatures as $sig)
                    <div class="p-3 bg-white border border-sena-verde/30 rounded glass-card">
                        <p class="text-sm text-gray-700">
                            <strong>Tipo:</strong> {{ ucfirst($sig->type) }}<br>
                            <strong>Usuario:</strong> {{ $sig->user->name }}<br>
                            <strong>Fecha:</strong> {{ $sig->created_at->format('d/m/Y H:i') }}
                        </p>
                        <img src="{{ asset('storage/' . $sig->signature_path) }}"
                             alt="Firma {{ $sig->type }}"
                             class="w-full h-32 object-contain mt-2 border">
                    </div>
                @endforeach
            </div>
        </x-glass-card>
    @endif

    {{-- Acciones Dinámicas --}}
    <div class="mt-6 flex flex-wrap gap-3">
        @can('approve', $loan)
            @if ($loan->status->name === 'solicitado')
                <form action="{{ route('prestamos.aprobar', $loan) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-sena">Aprobar solicitud</button>
                </form>
            @endif
        @endcan

        @can('deliver', $loan)
            @if ($loan->status->name === 'aprobado')
                <a href="{{ route('prestamos.entregar', $loan) }}" class="btn-sena">Registrar entrega</a>
            @endif
        @endcan

        @can('returnAsset', $loan)
            @if ($loan->status->name === 'entregado')
                <a href="{{ route('prestamos.devolver', $loan) }}" class="btn-sena">Registrar devolución</a>
            @endif
        @endcan
    </div>

</x-app-layout>

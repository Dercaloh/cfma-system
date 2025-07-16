<x-app-layout :header="'Depuración de Préstamo #' . $loan->id">

    <x-glass-card title="Depuración del Modelo Loan">
        <pre class="text-sm bg-gray-100 p-4 rounded overflow-x-auto">
ID: {{ $loan->id }}
Solicitante: {{ $loan->user?->name ?? 'null' }} (ID: {{ $loan->user?->id ?? 'null' }})
Activo: {{ $loan->asset?->name ?? 'null' }} (ID: {{ $loan->asset?->id ?? 'null' }})
Estado: {{ $loan->status?->name ?? 'null' }} (ID: {{ $loan->status?->id ?? 'null' }})
Solicitado: {{ $loan->requested_at }}
Aprobado: {{ $loan->approved_at }}
Entregado: {{ $loan->delivered_at }}
Devuelto: {{ $loan->returned_at }}
Notas: {{ $loan->notes ?? '(sin notas)' }}
        </pre>
    </x-glass-card>

    @if($loan->details)
    <x-glass-card title="Detalles adicionales">
        <pre class="text-sm bg-gray-100 p-4 rounded overflow-x-auto">
Tipo de uso: {{ $loan->details->tipo_de_uso }}
Ficha: {{ $loan->details->ficha }}
Programa: {{ $loan->details->programa }}
Instructor: {{ $loan->details->instructor }}
Cargo: {{ $loan->details->cargo }}
Departamento: {{ $loan->details->departamento }}
Sede: {{ $loan->details->sede }}
Hora entrega: {{ $loan->details->hora_entrega }}
Cantidad: {{ $loan->details->cantidad }}
Propósito: {{ $loan->details->proposito }}
        </pre>
    </x-glass-card>
    @endif

    @if($loan->signatures->isNotEmpty())
    <x-glass-card title="Firmas registradas (raw)">
        <pre class="text-sm bg-gray-100 p-4 rounded overflow-x-auto">
@foreach($loan->signatures as $sig)
- {{ $sig->type }} por {{ $sig->user?->name ?? '(sin usuario)' }} en {{ $sig->created_at }}
  Firma: {{ $sig->signature_path }}
@endforeach
        </pre>
    </x-glass-card>
    @endif

</x-app-layout>

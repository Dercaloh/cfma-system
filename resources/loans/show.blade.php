{{-- resources/views/loans/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">Detalle de Préstamo</x-slot>

    <x-glass-container>
        <p><strong>Activo:</strong> {{ $loan->asset->serial_number }} ({{ $loan->asset->type }})</p>
        <p><strong>Estado:</strong> {{ ucfirst($loan->status->name) }}</p>
        <p><strong>Solicitado por:</strong> {{ $loan->user->name }}</p>
        <p><strong>Fecha inicio:</strong> {{ $loan->start_date }}</p>
        <p><strong>Fecha fin:</strong> {{ $loan->end_date }}</p>
        <p><strong>Entrega:</strong> {{ $loan->delivered_at ?? '---' }}</p>
        <p><strong>Devolución:</strong> {{ $loan->returned_at ?? '---' }}</p>
        <p><strong>Notas:</strong> {{ $loan->notes }}</p>

        <hr class="my-4">

        <h3 class="text-lg font-bold mb-2">Firmas</h3>
        @foreach ($loan->signatures as $signature)
            <p><strong>{{ ucfirst($signature->type) }}:</strong> {{ $signature->user->name }}
                <a href="{{ asset('storage/'.$signature->signature_path) }}" target="_blank" class="underline text-blue-500">ver firma</a>
            </p>
        @endforeach
    </x-glass-container>
</x-app-layout>

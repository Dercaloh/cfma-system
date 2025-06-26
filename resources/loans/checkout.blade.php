{{-- resources/views/loans/checkout.blade.php --}}
<x-app-layout>
    <x-slot name="header">Registrar Entrega</x-slot>

    <x-glass-container>
        <form method="POST" action="{{ route('prestamos.entregar', $loan) }}" enctype="multipart/form-data">
            @csrf

            <p><strong>Activo:</strong> {{ $loan->asset->serial_number }}</p>

            <div class="mt-4">
                <label>Firma del responsable (PNG o SVG)</label>
                <input type="file" name="signature" accept=".png,.svg" class="w-full p-2 rounded border" required>
            </div>

            <button type="submit" class="mt-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Confirmar Entrega
            </button>
        </form>
    </x-glass-container>
</x-app-layout>

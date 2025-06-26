{{-- resources/views/loans/checkin.blade.php --}}
<x-app-layout>
    <x-slot name="header">Registrar Devolución</x-slot>

    <x-glass-container>
        <form method="POST" action="{{ route('prestamos.devolver', $loan) }}" enctype="multipart/form-data">
            @csrf

            <p><strong>Activo:</strong> {{ $loan->asset->serial_number }}</p>

            <div class="mt-4">
                <label>Firma de devolución</label>
                <input type="file" name="signature" accept=".png,.svg" class="w-full p-2 rounded border" required>
            </div>

            <button type="submit" class="mt-6 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                Confirmar Devolución
            </button>
        </form>
    </x-glass-container>
</x-app-layout>

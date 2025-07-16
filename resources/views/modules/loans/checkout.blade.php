{{--resources/views/prestamos/checkout.blade.php--}}
<x-app-layout>
    <x-glass-container>
        <h2 class="text-2xl font-bold mb-4">Entrega de Activo</h2>

        <form method="POST" action="{{ route('prestamos.entregar', $loan) }}" enctype="multipart/form-data">
            @csrf
            <p>Estás entregando el activo: <strong>{{ $loan->asset->name }}</strong></p>

            <label for="signature" class="block mt-4">Firma digital (PNG o SVG):</label>
            <input type="file" name="signature" accept=".png,.svg" required class="mt-2">

            <button type="submit" class="mt-4 px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">
                Registrar entrega
            </button>
        </form>

        <div class="mt-6">
            <a href="{{ route('prestamos.index') }}" class="text-green-700 hover:underline">← Volver</a>
        </div>
    </x-glass-container>
</x-app-layout>

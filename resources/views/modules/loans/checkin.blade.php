{{--resources/views/prestamos/checkin.blade.php--}}
<x-app-layout>
    <x-glass-container>
        <h2 class="text-2xl font-bold mb-4">Devolución de Activo</h2>

        <form method="POST" action="{{ route('prestamos.devolver', $loan) }}" enctype="multipart/form-data">
            @csrf
            <p>Estás recibiendo de vuelta el activo: <strong>{{ $loan->asset->name }}</strong></p>

            <label for="signature" class="block mt-4">Firma digital (PNG o SVG):</label>
            <input type="file" name="signature" accept=".png,.svg" required class="mt-2">

            <button type="submit" class="mt-4 px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                Registrar devolución
            </button>
        </form>

        <div class="mt-6">
            <a href="{{ route('prestamos.index') }}" class="text-blue-700 hover:underline">← Volver</a>
        </div>
    </x-glass-container>
</x-app-layout>

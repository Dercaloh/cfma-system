{{-- resources/views/loans/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">Solicitar Préstamo</x-slot>

    <x-glass-container>
        <form method="POST" action="{{ route('prestamos.store') }}">
            @csrf

            <label class="block mb-2">Activo</label>
            <select name="asset_id" class="w-full rounded p-2 border bg-white text-black" required>
                @foreach ($assets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->serial_number }} - {{ $asset->type }}</option>
                @endforeach
            </select>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label>Fecha inicio</label>
                    <input type="date" name="start_date" class="w-full p-2 rounded border" required>
                </div>
                <div>
                    <label>Fecha fin</label>
                    <input type="date" name="end_date" class="w-full p-2 rounded border" required>
                </div>
            </div>

            <div class="mt-4">
                <label>Hora de entrega (07:00 - 18:00)</label>
                <input type="time" name="delivery_hour" class="w-full p-2 rounded border" required>
            </div>

            <div class="mt-4">
                <label>Observaciones</label>
                <textarea name="notes" class="w-full p-2 rounded border" rows="3"></textarea>
            </div>

            <button type="submit" class="mt-6 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Enviar Solicitud
            </button>
        </form>
    </x-glass-container>
</x-app-layout>

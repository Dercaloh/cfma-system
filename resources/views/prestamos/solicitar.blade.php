<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-sena-azul drop-shadow-sm">
            Nueva Solicitud de Préstamo
        </h2>
    </x-slot>

    <div class="glass-card max-w-2xl mx-auto p-6 rounded-xl shadow-lg space-y-6">
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 border border-red-300 p-4 rounded mb-4">
                <strong>Verifica los campos:</strong>
                <ul class="list-disc pl-5 mt-2 text-sm">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('prestamos.store') }}" x-data="{ tipoUso: '{{ old('tipo_de_uso') }}' }" novalidate>
            @csrf

            <label class="block text-sm font-medium">Activo</label>
            <select name="asset_id" required class="form-input w-full mb-4">
                <option value="">Seleccione...</option>
                @foreach($assetsDisponibles as $asset)
                    <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                        {{ $asset->name }} ({{ ucfirst($asset->type) }})
                    </option>
                @endforeach
            </select>

            <label class="block text-sm font-medium">Cantidad</label>
            <input name="cantidad" type="number" min="1" value="{{ old('cantidad',1) }}" required class="form-input w-full mb-4">

            <label class="block text-sm font-medium">Tipo de Uso</label>
            <select name="tipo_de_uso" x-model="tipoUso" required class="form-input w-full mb-4">
                <option value="">Seleccione...</option>
                <option value="formativo">Formativo</option>
                <option value="administrativo">Administrativo</option>
            </select>

            <template x-if="tipoUso === 'formativo'">
              <div class="space-y-2 mb-4">
                <input name="ficha" placeholder="Ficha" value="{{ old('ficha') }}" class="form-input w-full">
                <input name="programa" placeholder="Programa" value="{{ old('programa') }}" class="form-input w-full">
                <input name="instructor" placeholder="Instructor" value="{{ old('instructor') }}" class="form-input w-full">
              </div>
            </template>

            <template x-if="tipoUso === 'administrativo'">
              <div class="space-y-2 mb-4">
                <input name="cargo" placeholder="Cargo" value="{{ old('cargo') }}" class="form-input w-full">
                <input name="departamento" placeholder="Departamento" value="{{ old('departamento') }}" class="form-input w-full">
                <textarea name="proposito" placeholder="Propósito" class="form-input w-full">{{ old('proposito') }}</textarea>
              </div>
            </template>

            <label class="block text-sm font-medium">Sede</label>
            <input name="sede" type="text" value="{{ old('sede') }}" required class="form-input w-full mb-4">

            <label class="block text-sm font-medium">Hora de Entrega</label>
            <input name="hora_entrega" type="time" value="{{ old('hora_entrega') }}" required class="form-input w-full mb-4">

            <label class="block text-sm font-medium">Notas (opcional)</label>
            <textarea name="notes" class="form-input w-full">{{ old('notes') }}</textarea>

            <button type="submit" class="glass-btn w-full mt-4">
                Enviar Solicitud
            </button>
        </form>
    </div>
</x-app-layout>

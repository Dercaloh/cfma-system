{{-- resources/views/components/fields/policy-consent-checkbox.blade.php --}}
@props([
    'name' => 'consent_data_processing',
    'required' => true,
    'version' => '1.0.0',
])

<div class="mt-6">
    <div class="flex items-start gap-3 p-4 border shadow-inner rounded-xl bg-white/80 border-sena-verde/20">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $name }}"
            class="mt-1 border-gray-300 rounded shrink-0 text-sena-verde focus:ring-sena-verde focus:ring-2 focus-visible:outline-none focus-visible:ring-sena-azul"
            value="1"
            {{ old($name) ? 'checked' : '' }}
            @if ($required) required @endif
            aria-describedby="{{ $name }}-description"
        >

        <label for="{{ $name }}" class="text-sm leading-relaxed text-gray-800 cursor-pointer">
            Acepto el
            <a href="{{ route('politicas.show') }}"
               target="_blank"
               class="underline text-sena-azul hover:text-sena-verde focus-visible:ring focus-visible:ring-sena-azul focus:outline-none">
               tratamiento de mis datos personales
            </a>
            según lo establecido en la versión <strong>{{ $version }}</strong> de la política de protección de datos.
        </label>
    </div>

    @error($name)
        <p id="{{ $name }}-description" class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
    @enderror
</div>

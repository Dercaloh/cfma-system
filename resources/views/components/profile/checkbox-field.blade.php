@props(['name', 'label', 'checked' => false])

<div class="flex items-start space-x-2">
    {{-- Truco para enviar false si no está marcado --}}
    <input type="hidden" name="{{ $name }}" value="0">

    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $name }}"
        class="mt-1 rounded text-sena-verde focus:ring-sena-verde"
        value="1"
        {{ $checked ? 'checked' : '' }}
    >

    <label for="{{ $name }}" class="text-sm text-gray-700">
        {{ $label }}
    </label>
</div>

@error($name)
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror

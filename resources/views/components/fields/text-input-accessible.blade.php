{{-- resources/views/components/fields/text-input-accessible.blade.php --}}
@props([
    'id',
    'name',
    'type' => 'text',
    'label',
    'value' => '',
    'required' => false,
    'autofocus' => false,
    'placeholder' => '',
])

<div class="mb-4">
    <label for="{{ $id }}" class="block mb-1 text-sm font-semibold text-gray-800">
        {{ $label }}
        @if ($required)
            <span class="text-red-600" aria-hidden="true">*</span>
        @endif
    </label>

    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        aria-required="{{ $required ? 'true' : 'false' }}"
        aria-invalid="@error($name) true @else false @enderror"
        {{ $required ? 'required' : '' }}
        {{ $autofocus ? 'autofocus' : '' }}
        class="w-full px-4 py-2 text-sm transition duration-150 ease-in-out border border-gray-300 rounded-lg shadow-sm bg-white/90 backdrop-blur focus:outline-none focus:ring-2 focus:ring-sena-verde focus:border-sena-verde"
    >

    @error($name)
        <p class="mt-1 text-sm text-red-600" id="{{ $id }}-error">
            {{ $message }}
        </p>
    @enderror
</div>

{{-- resources/views/components/fields/checkbox-accessible.blade.php --}}
@props([
    'id',
    'name',
    'label',
    'checked' => false,
    'required' => false,
])

<div class="flex items-start mb-4 space-x-3">
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="checkbox"
        value="1"
        class="mt-1 border-gray-300 rounded-sm text-sena-verde focus:ring-sena-verde"
        {{ old($name, $checked) ? 'checked' : '' }}
        {{ $required ? 'required' : '' }}
        aria-checked="{{ old($name, $checked) ? 'true' : 'false' }}"
        aria-required="{{ $required ? 'true' : 'false' }}"
    >

    <label for="{{ $id }}" class="text-sm text-gray-700 select-none">
        {{ $label }}
        @if ($required)
            <span class="text-red-600" aria-hidden="true">*</span>
        @endif
    </label>
</div>

@error($name)
    <p class="mt-1 text-sm text-red-600" id="{{ $id }}-error">
        {{ $message }}
    </p>
@enderror

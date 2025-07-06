@props([
    'id' => '',
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'autofocus' => false,
])

<div class="space-y-1">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>

    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $autofocus ? 'autofocus' : '' }}
        class="block w-full px-4 py-2 mt-1 text-gray-900 placeholder-gray-400 bg-white border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-sena-azul focus:border-sena-azul sm:text-sm"
    >

    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

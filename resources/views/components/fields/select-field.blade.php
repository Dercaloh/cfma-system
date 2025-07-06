{{-- resources/views/components/fields/select-field.blade.php --}}
@props([
    'id' => null,
    'label' => '',
    'name',
    'options' => [],
    'value' => '',
    'required' => false,
    'readonly' => false,
    'placeholder' => '-- Selecciona una opción --',
    'description' => '',
])

@php
    $id = $id ?? $name . '-' . uniqid();
@endphp

<div class="space-y-1">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}@if($required)<span class="text-red-600">*</span>@endif
        </label>
    @endif

    <select
        id="{{ $id }}"
        name="{{ $name }}"
        @if($required) required @endif
        @if($readonly) disabled @endif
        aria-describedby="{{ $id }}-description"
        class="block w-full px-3 py-2 text-sm text-gray-900 border-gray-300 rounded-md shadow-sm focus:ring-sena-azul focus:border-sena-verde disabled:opacity-70"
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $key => $option)
            <option value="{{ $key }}" @selected($value == $key)>{{ $option }}</option>
        @endforeach
    </select>

    @if($description)
        <p id="{{ $id }}-description" class="text-xs text-gray-500">{{ $description }}</p>
    @endif

    <x-input-error :messages="$errors->get($name)" class="mt-1 text-sm text-red-600" />
</div>

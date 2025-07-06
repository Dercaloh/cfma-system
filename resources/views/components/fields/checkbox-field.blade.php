{{-- checkbox-field.blade.php --}}
@props([
    'id' => null,
    'label' => '',
    'name' => '',
    'value' => 1,
    'checked' => false,
    'required' => false,
    'readonly' => false,
    'description' => '',
])

@php
    $id = $id ?? $name . '-' . uniqid();
@endphp

<div class="flex items-start space-x-2">
    <div class="flex items-center h-5">
        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="checkbox"
            value="{{ $value }}"
            @if($checked) checked @endif
            @if($required) required @endif
            @if($readonly) disabled @endif
            class="w-4 h-4 border-gray-300 rounded text-sena-verde focus:ring-sena-azul disabled:opacity-50 disabled:cursor-not-allowed"
        >
    </div>
    <div class="text-sm">
        @if($label)
            <label for="{{ $id }}" class="font-medium text-gray-700 cursor-pointer">
                {{ $label }}@if($required)<span class="text-red-600">*</span>@endif
            </label>
        @endif

        @if($description)
            <p id="{{ $id }}-description" class="text-xs text-gray-500">{{ $description }}</p>
        @endif

        <x-input-error :messages="$errors->get($name)" class="mt-1 text-sm text-red-600" />
    </div>
</div>

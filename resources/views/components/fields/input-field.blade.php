@props([
    'id' => null,
    'label' => '',
    'type' => 'text',
    'name' => '',
    'value' => '',
    'description' => '',
    'required' => false,
    'readonly' => false,
    'options' => null
])

@php
    $id = $id ?? $name . '-' . uniqid();
    $hasError = $errors->has($name);
    $errorId = $hasError ? $id . '-error' : null;
    $describedBy = collect([$description ? $id . '-description' : null, $errorId])->filter()->implode(' ');
@endphp

<div class="space-y-1">
    @if($label)
        <label for="{{ $id }}" class="form-label">
            {{ $label }}@if($required)<span class="text-red-600">*</span>@endif
        </label>
    @endif

    @if($type === 'select')
        <select id="{{ $id }}"
                name="{{ $name }}"
                class="form-input @if($hasError) border-red-500 ring-red-500 focus:ring-red-500 @endif"
                @if($required) required @endif
                @if($readonly) readonly @endif
                @if($hasError) aria-invalid="true" aria-describedby="{{ $describedBy }}" @endif>
            <option value="">Seleccione...</option>
            @foreach($options as $optVal => $optLabel)
                <option value="{{ $optVal }}" @selected($optVal == old($name, $value))>{{ $optLabel }}</option>
            @endforeach
        </select>
    @else
        <input id="{{ $id }}"
               name="{{ $name }}"
               type="{{ $type }}"
               value="{{ old($name, $value) }}"
               class="form-input @if($hasError) border-red-500 ring-red-500 focus:ring-red-500 @endif"
               @if($required) required @endif
               @if($readonly) readonly @endif
               @if($hasError) aria-invalid="true" aria-describedby="{{ $describedBy }}" @endif>
    @endif

    @if($description)
        <p id="{{ $id }}-description" class="text-sm text-gray-500 form-description">{{ $description }}</p>
    @endif

    @if($hasError)
        <p id="{{ $errorId }}" class="text-sm text-red-600 form-error" role="alert">
            {{ $errors->first($name) }}
        </p>
    @endif
</div>

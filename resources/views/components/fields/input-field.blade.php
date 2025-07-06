{{-- resources/views/components/fields/input-field.blade.php --}}
@props([
  'id'=>null,'label'=>'','type'=>'text','name'=>'','value'=>'',
  'description'=>'','required'=>false,'readonly'=>false,
  'options'=>null // nuevo para selects
])
@php
  $id = $id ?? $name . '-' . uniqid();
@endphp
<div class="space-y-1">
  @if($label)
      <label for="{{ $id }}" class="form-label">{{ $label }}@if($required)<span class="text-red-600">*</span>@endif</label>
  @endif

  @if($type==='select')
    <select id="{{ $id }}" name="{{ $name }}"
      class="form-input">
      <option value="">Seleccione...</option>
      @foreach($options as $optVal => $optLabel)
        <option value="{{ $optVal }}" @selected($optVal == $value)>{{ $optLabel }}</option>
      @endforeach
    </select>
  @else
    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name,$value) }}"
      class="form-input" @if($required) required @endif @if($readonly) readonly @endif>
  @endif

  @if($description)
      <p id="{{ $id }}-description" class="form-description">{{ $description }}</p>
  @endif
  <x-input-error :messages="$errors->get($name)" class="form-error" />
</div>

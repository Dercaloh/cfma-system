@props([
    'id' => 'autocomplete-' . Str::uuid(),
    'name',
    'label' => '',
    'options' => [], // ['CC' => 'Cédula de ciudadanía']
    'value' => '',
    'required' => false,
    'placeholder' => 'Seleccione o escriba...',
])

@php
    $selectedLabel = $options[$value] ?? '';
@endphp

<div x-data="autocompleteSelect('{{ $id }}', @js($options), '{{ $value }}')" x-init="init()" class="relative">
    @if ($label)
        <label for="{{ $id }}-input" class="block mb-1 text-sm font-medium text-gray-700">
            {{ $label }}
            @if ($required)
                <span class="text-red-600">*</span>
            @endif
        </label>
    @endif

    <input
        x-ref="input"
        x-model="search"
        @input.debounce.200ms="filterOptions"
        @focus="open = true"
        @blur="setTimeout(validateInput, 100)"
        @keydown.escape="open = false"
        @keydown.arrow-down.prevent="highlightNext()"
        @keydown.arrow-up.prevent="highlightPrev()"
        @keydown.enter.prevent="selectHighlighted()"
        :aria-expanded="open"
        :aria-activedescendant="highlightedId"
        role="combobox"
        aria-controls="{{ $id }}-listbox"
        aria-autocomplete="list"
        id="{{ $id }}-input"
        type="text"
        class="w-full px-4 py-2 text-sm text-gray-800 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        :required="@js($required)"
        :aria-invalid="errorMessage ? 'true' : 'false'"
        aria-describedby="{{ $id }}-error"
    >

    <input type="hidden" name="{{ $name }}" :value="selected">

    <ul
        x-show="open && filteredOptions.length > 0"
        x-transition
        id="{{ $id }}-listbox"
        class="absolute z-10 w-full mt-1 overflow-auto text-sm bg-white border border-gray-300 rounded-md shadow-lg max-h-60"
        role="listbox"
    >
        <template x-for="([key, label]) in filteredOptions" :key="key">
            <li
                :id="`${id}-option-${key}`"
                role="option"
                :aria-selected="key === selected"
                @mousedown.prevent="selectOption(key)"
                @mouseenter="highlighted = key"
                :class="{
                    'bg-blue-100 text-blue-900': key === highlighted,
                    'px-4 py-2 cursor-pointer hover:bg-blue-50': true
                }"
                x-text="label"
            ></li>
        </template>
    </ul>

    <div x-show="errorMessage" id="{{ $id }}-error" class="mt-1 text-sm text-red-600" role="alert" x-text="errorMessage"></div>
</div>

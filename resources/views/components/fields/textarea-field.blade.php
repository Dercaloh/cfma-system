@props(['name', 'label', 'value' => '', 'placeholder' => '', 'rows' => 3, 'help' => ''])

<div>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-700">
        {{ $label }}
        <span class="font-normal text-gray-500">(opcional)</span>
    </label>
    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}"
        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm resize-none focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
        placeholder="{{ $placeholder }}">{{ $value }}</textarea>
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
    @if($help)
        <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endif
</div>

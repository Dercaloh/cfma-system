{{-- resources/views/components/filters/results-per-page-selector.blade.php --}}
@props([
    'value' => 25,
    'options' => [10, 25, 50, 100]
])

<div class="flex items-center gap-2">
    <label for="per_page" class="text-sm text-gray-600">Mostrar:</label>
    <select name="per_page" id="per_page" onchange="this.form.submit()"
            class="px-3 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        @foreach($options as $option)
            <option value="{{ $option }}" {{ $value == $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
</div>

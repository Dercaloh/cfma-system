@props([
    'label' => '',
    'value' => '—'
])

<div>
    <p class="text-sm font-semibold text-gray-600">{{ $label }}</p>
    <p class="text-gray-800">{{ $value }}</p>
</div>

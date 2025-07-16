{{-- resources/views/components/data-grid/table-filters.blade.php --}}
@props([
    'filters' => [],
    'activeFilters' => [],
    'searchQuery' => '',
    'action' => '',
    'method' => 'GET',
    'id' => 'table-filters',
    'collapsible' => true,
    'showClearAll' => true,
    'showApplyButton' => false,
    'class' => ''
])

@php
    $filterId = $id . '-' . uniqid();
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-sena-gris-200 mb-6 ' . $class]) }}>

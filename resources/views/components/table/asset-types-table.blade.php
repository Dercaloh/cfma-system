@props([
    'assetType',
    'searchTerm' => '',
])

@php
    use Illuminate\Support\Str;

    $isDeleted = method_exists($assetType, 'trashed') && $assetType->trashed();
@endphp

<tr class="transition-colors hover:bg-sena-gris-claro/20">
    {{-- Nombre con resaltado --}}
    <td class="px-6 py-4 font-medium whitespace-nowrap">
        <x-ui.search-highlight :text="$assetType->name" :search="$searchTerm" />
    </td>

    {{-- Descripción --}}
    <td class="px-6 py-4 text-sm text-sena-gris-oscuro whitespace-nowrap">
        {{ $assetType->description ? Str::limit($assetType->description, 80) : '—' }}
    </td>

    {{-- Estado --}}
    <td class="px-6 py-4">
        <x-ui.status-badge :active="$assetType->active ?? false" :deleted="$isDeleted" />
    </td>

    {{-- Fecha de creación --}}
    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
        {{ $assetType->created_at?->format('Y-m-d') ?? '—' }}
    </td>

    {{-- Acciones --}}
    <td class="px-6 py-4 text-right whitespace-nowrap">
        <x-table.table-row-actions
            :item="$assetType"
            showRoute="admin.tipos_activos.show"
            editRoute="admin.tipos_activos.edit"
            deleteRoute="admin.tipos_activos.destroy"
            restoreRoute="admin.tipos_activos.restore"
            forceDeleteRoute="admin.tipos_activos.forceDelete"
        />
    </td>
</tr>

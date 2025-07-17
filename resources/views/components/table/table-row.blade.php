@props(['assetType', 'searchTerm' => null])
@php
    $isDeleted = $assetType->trashed();
    $status = $isDeleted
        ? 'custom'
        : ($assetType->active ? 'active' : 'inactive');
@endphp
<tr class="table-row">
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-10 h-10">
                <div
                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                    <x-ui.search-highlight :text="$assetType->name" :search="$searchTerm" />
                </div>
                <div class="text-sm text-gray-500">
                    ID: {{ $assetType->id }}
                </div>
            </div>
        </div>
    </td>

    <td class="px-6 py-4">
        <div class="max-w-xs text-sm text-gray-900 truncate">
            <x-ui.search-highlight :text="$assetType->description ?? 'Sin descripción'" :search="$searchTerm" />
        </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
         <x-ui.status-badge
        :status="$assetType->trashed()
            ? 'inactive'
            : ($assetType->active ? 'active' : 'inactive')"
    />
    </td>

    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
        <div class="flex flex-col">
            <span>{{ $assetType->created_at->format('d/m/Y') }}</span>
            <span class="text-xs text-gray-400">{{ $assetType->created_at->format('H:i') }}</span>
        </div>
    </td>

    <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
        <x-buttons.table-row-actions :item="$assetType" showRoute="admin.tipos_activos.show"
            editRoute="admin.tipos_activos.edit" deleteRoute="admin.tipos_activos.destroy" />
    </td>
</tr>

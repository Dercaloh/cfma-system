{{-- resources/views/components/table/asset-types-table.blade.php --}}
@props([
    'assetTypes',
    'searchTerm' => ''
])

<div class="overflow-hidden bg-white shadow-lg rounded-xl">
    @if($assetTypes->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <x-table.table-header />
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($assetTypes as $assetType)
                        <x-table.table-row
                            :assetType="$assetType"
                            :searchTerm="$searchTerm"
                        />
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <x-table.empty-state />
    @endif
</div>

@props([
    'columns' => [],
    'currentSort' => null,
    'currentDirection' => 'asc',
    'baseRoute' => '',
    'queryParams' => []
])

<thead class="bg-gray-50">
    <tr>
        @foreach($columns as $column)
            <th class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase {{ $column['class'] ?? '' }}">
                @if(isset($column['sortable']) && $column['sortable'])
                    <x-ui.sortable-header
                        :label="$column['label']"
                        :sort-key="$column['key']"
                        :current-sort="$currentSort"
                        :current-direction="$currentDirection"
                        :base-route="$baseRoute"
                        :query-params="$queryParams"
                    />
                @else
                    {{ $column['label'] }}
                @endif
            </th>
        @endforeach
    </tr>
</thead>

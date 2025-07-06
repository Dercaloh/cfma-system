@props([
    'permissions' => collect(),
    'limit' => 3,
])

<div x-data="{ expanded: false }" class="flex flex-wrap gap-1">
    @foreach($permissions->take($limit) as $perm)
        <span class="inline-flex items-center px-2 py-0.5 text-xs text-white bg-gray-700 rounded-full">
            {{ $perm->name }}
        </span>
    @endforeach

    @if($permissions->count() > $limit)
        <template x-if="!expanded">
            <button @click="expanded = true"
                    class="text-xs text-blue-600 hover:underline focus:outline-none"
                    aria-expanded="false">
                +{{ $permissions->count() - $limit }} más
            </button>
        </template>

        <template x-if="expanded">
            @foreach($permissions->slice($limit) as $perm)
                <span class="inline-flex items-center px-2 py-0.5 text-xs text-white bg-gray-500 rounded-full">
                    {{ $perm->name }}
                </span>
            @endforeach
        </template>
    @endif
</div>

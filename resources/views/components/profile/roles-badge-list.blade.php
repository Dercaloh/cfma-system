@props([
    'roles' => collect(),
    'limit' => 3,
])

<div x-data="{ expanded: false }" class="flex flex-wrap gap-1">
    @foreach($roles->take($limit) as $role)
        <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-white bg-indigo-600 rounded-full">
            {{ $role->name }}
        </span>
    @endforeach

    @if($roles->count() > $limit)
        <template x-if="!expanded">
            <button @click="expanded = true"
                    class="text-xs text-blue-600 hover:underline focus:outline-none"
                    aria-expanded="false">
                +{{ $roles->count() - $limit }} más
            </button>
        </template>

        <template x-if="expanded">
            @foreach($roles->slice($limit) as $role)
                <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-white bg-indigo-400 rounded-full">
                    {{ $role->name }}
                </span>
            @endforeach
        </template>
    @endif
</div>

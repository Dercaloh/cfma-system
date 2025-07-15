@props(['paginator'])

@if ($paginator && $paginator->count())
    <div class="text-sm text-gray-700">
        Mostrando
        <span class="font-semibold">{{ $paginator->firstItem() ?? 0 }}</span>
        a
        <span class="font-semibold">{{ $paginator->lastItem() ?? 0 }}</span>
        de
        <span class="font-semibold">{{ $paginator->total() }}</span>
        resultados
    </div>
@endif

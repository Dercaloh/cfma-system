@php($paginator = $attributes->get('paginator'))

@if ($paginator && $paginator->count())
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
            <div class="text-sm text-gray-700">
                Mostrando {{ $paginator->firstItem() ?? 0 }} a {{ $paginator->lastItem() ?? 0 }} de {{ $paginator->total() }} resultados
            </div>
            {{ $paginator->appends(request()->query())->links() }}
        </div>
    </div>
@endif

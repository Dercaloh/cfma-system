<form id="export-form" method="POST" action="{{ route('admin.usuarios.export') }}">
    @csrf
    <div class="flex items-center gap-2">
        <select name="export_type" id="export_type" class="form-select">
            <option value="all">Exportar Todos</option>
            <option value="current">Solo Seleccionados</option>
        </select>
        <input type="hidden" name="user_ids" id="user-ids-input" value="">
        <button type="submit" class="btn-sena bg-sena-verde">
            <x-heroicon-o-document-arrow-down class="w-4 h-4 mr-1" />
            Exportar
        </button>
    </div>
</form>

<form id="export-form" method="POST" action="{{ route('admin.usuarios.export') }}">
    @csrf
    <div class="flex items-center gap-2">
        <!-- Solo exportar todos los usuarios (backup) -->
        <input type="hidden" name="type" value="all">

        <select name="format" id="export_format" class="form-select" required>
            <option value="xlsx">Excel (.xlsx)</option>
            <option value="csv">CSV (.csv)</option>
        </select>

        <button type="submit" class="flex items-center btn-sena bg-sena-verde">
            <x-heroicon-o-document-arrow-down class="w-4 h-4 mr-1" />
            Exportar usuarios (Backup)
        </button>
    </div>
</form>

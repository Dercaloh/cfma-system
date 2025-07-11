<x-app-layout>
    <x-slot name="header">
        <x-profile.profile-title icon="users" title="Listado Oficial de Usuarios Activos" />
    </x-slot>

    <section class="p-6 mx-auto space-y-6 max-w-7xl">
        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.usuarios.create') }}" class="btn-sena">
                <x-heroicon-o-plus class="w-4 h-4 mr-1" /> Crear Usuario
            </a>
            <a href="{{ route('admin.usuarios.import') }}" class="bg-white border btn-sena text-sena-verde border-sena-verde hover:bg-sena-gris">
                <x-heroicon-o-arrow-up-tray class="w-4 h-4 mr-1" /> Importar Excel
            </a>
        </div>

        {{-- Exportar --}}
        @include('modules.usuarios.partials.export-form')

        {{-- Tabla --}}
        @include('modules.usuarios.partials.table')

        {{-- Scripts accesibles --}}
        @include('modules.usuarios.partials.scripts')
    </section>
</x-app-layout>

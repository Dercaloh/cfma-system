<x-app-layout>
  <x-slot name="header">
    <x-layout.context-header>
      <h2 class="text-2xl font-bold text-sena-verde">Usuarios Registrados</h2>
    </x-layout.context-header>
  </x-slot>

  <div class="flex justify-end mb-6 space-x-2">
    <a href="{{ route('admin.usuarios.create') }}"
       class="inline-flex items-center px-4 py-2 text-sm text-white rounded bg-sena-verde hover:bg-green-700">
      <x-heroicon-o-plus class="w-4 h-4 mr-1" /> Crear Usuario
    </a>
    <a href="{{ route('admin.usuarios.import') }}"
       class="inline-flex items-center px-4 py-2 text-sm bg-white border rounded text-sena-verde border-sena-verde hover:bg-green-50">
      <x-heroicon-o-arrow-up-tray class="w-4 h-4 mr-1" /> Importar Excel
    </a>
  </div>

  @include('usuarios.partials.table')

</x-app-layout>

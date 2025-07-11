<x-app-layout>
    <x-slot name="header">
        <x-profile.profile-title icon="document-arrow-up" title="Importar Usuarios desde Excel" />
    </x-slot>

    <section class="max-w-3xl p-6 mx-auto space-y-6">
        @include('modules.usuarios.partials.import-info')

        <x-profile.section-card>
            <form action="{{ route('admin.usuarios.import.handle') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="form-label" for="file">Selecciona archivo Excel:</label>
                <input type="file" id="file" name="file" class="form-input" accept=".xlsx,.csv" required>
                <button type="submit" class="mt-4 btn-sena">Importar</button>
            </form>
        </x-profile.section-card>
    </section>
</x-app-layout>

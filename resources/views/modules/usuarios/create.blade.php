<x-app-layout>
    <x-slot name="header">
        <x-profile.profile-title icon="user-plus" title="Registrar Usuario" />
    </x-slot>

    <section class="max-w-4xl p-6 mx-auto">
        <x-profile.section-card>
            <form method="POST" action="{{ route('admin.usuarios.store') }}" class="space-y-6" novalidate>
                @csrf

                @include('modules.usuarios.partials.form', [
                    'user' => new \App\Models\Users\User(),
                    'branches' => $branches->pluck('name', 'id'),
                    'departments' => $departments,
                    'positions' => $positions,
                    'roles' => $roles,
                    'editableRoles' => true,
                    'locations' => [],
                ])

                <div class="flex justify-start gap-4 pt-4">
                    <x-buttons.primary-button>Registrar Usuario</x-buttons.primary-button>

                    <a href="{{ route('admin.usuarios.index') }}"
                       class="text-sm text-gray-600 underline hover:text-gray-800 focus-visible:outline focus-visible:ring focus-visible:ring-blue-500">
                        Cancelar
                    </a>
                </div>
            </form>
        </x-profile.section-card>
    </section>
</x-app-layout>

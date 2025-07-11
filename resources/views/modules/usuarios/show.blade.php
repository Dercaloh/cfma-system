<x-app-layout>
    <x-slot name="header">
        <x-profile.profile-title icon="user" :title="'Perfil de ' . $user->full_name" />
    </x-slot>

    <section class="p-6 mx-auto space-y-6 max-w-7xl">
        <x-profile.section-card>
            <h2 class="text-xl font-bold text-sena-verde">Información General</h2>
            <x-usuarios.partials.user-details :user="$user" />
        </x-profile.section-card>

        <x-profile.section-card>
            <h2 class="text-xl font-bold text-sena-verde">Documentos Asociados</h2>
            @if ($user->documents && $user->documents->count())
                <ul class="mt-2 text-sm text-gray-700 list-disc list-inside">
                    @foreach ($user->documents as $doc)
                        <li>
                            <a href="{{ route('admin.usuarios.documentos.download', $doc) }}"
                               class="underline text-sena-azul hover:text-sena-verde"
                               target="_blank" rel="noopener noreferrer">
                                {{ $doc->name }} ({{ strtoupper($doc->format) }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-2 text-sm italic text-gray-500">No hay documentos asociados a este usuario.</p>
            @endif
        </x-profile.section-card>

        <x-profile.section-card>
            <h2 class="text-xl font-bold text-sena-verde">Roles y Permisos</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($user->roles as $role)
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded bg-sena-gris">
                        Rol: {{ $role->name }}
                    </span>
                @endforeach

                @foreach ($user->permissions as $permission)
                    <span class="inline-block px-3 py-1 text-xs text-gray-700 border rounded bg-white/80 border-sena-verde/30">
                        Permiso: {{ $permission->name }}
                    </span>
                @endforeach
            </div>
        </x-profile.section-card>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.usuarios.index') }}" class="btn-sena">
                Volver al listado
            </a>
            <a href="{{ route('admin.usuarios.edit', $user) }}" class="btn-sena bg-sena-azul hover:bg-sena-azul-300">
                Editar Usuario
            </a>
        </div>
    </section>
</x-app-layout>

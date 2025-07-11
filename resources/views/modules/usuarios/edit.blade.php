<x-app-layout>
    <x-slot name="header">
        <x-profile.profile-title icon="user-cog" title="Editar Roles y Permisos: {{ $user->full_name }}" />
    </x-slot>

    <section class="max-w-5xl p-6 mx-auto">
        <x-profile.section-card>

            {{-- Formulario de asignación (todo debe estar dentro del form) --}}
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Información del usuario --}}
                <div class="mb-6">
                    <x-profile.profile-title icon="user" title="Información del usuario" />
                    <div class="grid grid-cols-1 gap-4 text-sm text-gray-800 sm:grid-cols-2">
                        <x-fields.input-field label="Nombre completo" value="{{ $user->full_name }}" readonly />
                        <x-fields.input-field label="Correo electrónico" value="{{ $user->email }}" readonly />
                        <x-fields.input-field label="Documento" value="{{ $user->employee_id ?? 'No registrado' }}" readonly />
                        <x-fields.input-field label="Ubicación" value="{{ $user->location->name ?? 'Sin asignar' }}" readonly />

                        {{-- Campo de área (select y crear nuevo) --}}
                        <x-fields.input-field
                            type="select"
                            name="department_id"
                            label="Área"
                            :options="$departments->pluck('name','id')"
                            :value="old('department_id', $user->department_id)"
                        />
                        <x-fields.input-field
                            type="text"
                            name="new_department"
                            label="Nueva área (opcional)"
                            placeholder="Ej: Coordinación TIC"
                            value="{{ old('new_department') }}"
                        />

                        {{-- Campo de cargo (select y crear nuevo) --}}
                        <x-fields.input-field
                            type="select"
                            name="position_id"
                            label="Cargo"
                            :options="$positions->pluck('title','id')"
                            :value="old('position_id', $positions->firstWhere('title', $user->job_title)?->id)"
                        />
                        <x-fields.input-field
                            type="text"
                            name="new_position"
                            label="Nuevo cargo (opcional)"
                            placeholder="Ej: Técnico en soporte"
                            value="{{ old('new_position') }}"
                        />
                    </div>
                </div>

                {{-- Roles --}}
                <div>
                    <x-profile.profile-title icon="shield" title="Roles asignados" />
                    <div class="grid gap-2 sm:grid-cols-2">
                        @forelse($roles as $role)
                            <x-fields.checkbox-field
                                name="roles[]"
                                label="{{ $role->name }}"
                                description="{{ $role->description }}"
                                value="{{ $role->name }}"
                                :checked="$user->hasRole($role->name)"
                            />
                        @empty
                            <p class="text-sm text-gray-500 col-span-full">No hay roles disponibles.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Permisos --}}
                <div>
                    <x-profile.profile-title icon="key" title="Permisos individuales" />
                    <div class="grid gap-2 sm:grid-cols-2">
                        @forelse($permissions as $permission)
                            <x-fields.checkbox-field
                                name="permissions[]"
                                label="{{ $permission->name }}"
                                value="{{ $permission->name }}"
                                :checked="$user->hasPermissionTo($permission->name)"
                            />
                        @empty
                            <p class="text-sm text-gray-500 col-span-full">No hay permisos disponibles.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Acciones --}}
                <div class="flex items-center justify-start pt-4 space-x-4">
                    <x-buttons.primary-button>
                        Guardar cambios
                    </x-buttons.primary-button>

                    <a href="{{ route('modules.usuarios.index') }}"
                       class="text-sm text-gray-600 underline hover:text-gray-800 focus-visible:outline focus-visible:ring focus-visible:ring-blue-500">
                        Cancelar
                    </a>
                </div>
            </form>

        </x-profile.section-card>
    </section>
</x-app-layout>

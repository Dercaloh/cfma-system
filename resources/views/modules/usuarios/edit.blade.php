<x-app-layout>
    <x-slot name="header">
        <x-profile.profile-title icon="user-cog" title="Editar Usuario: {{ $user->full_name }}" />
    </x-slot>

    <section class="max-w-5xl p-6 mx-auto">
        <x-profile.section-card>
            <form method="POST" action="{{ route('admin.usuarios.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Información general --}}
                <x-profile.profile-title icon="user" title="Información general del usuario" />
                <div class="grid grid-cols-1 gap-4 text-sm text-gray-800 sm:grid-cols-2">
                    <x-fields.input-field label="Nombres" name="first_name" value="{{ old('first_name', $user->first_name) }}" required />
                    <x-fields.input-field label="Apellidos" name="last_name" value="{{ old('last_name', $user->last_name) }}" required />
                    <x-fields.input-field label="Correo institucional" name="email" type="email" value="{{ old('email', $user->email) }}" required />
                    <x-fields.input-field label="Correo personal" name="personal_email" type="email" value="{{ old('personal_email', $user->personal_email) }}" />
                    <x-fields.input-field label="Teléfono de contacto" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" />
                    <x-fields.input-field label="Nombre de usuario" name="username" value="{{ old('username', $user->username) }}" required />
                    <x-fields.input-field label="Tipo de documento" name="document_type" type="select"
                        :options="['CC' => 'Cédula de Ciudadanía', 'TI' => 'Tarjeta de Identidad', 'CE' => 'Cédula de Extranjería', 'PA' => 'Pasaporte', 'NIT' => 'NIT']"
                        :value="old('document_type', $user->document_type)" required />
                    <x-fields.input-field label="Número de documento" name="identification_number" value="{{ old('identification_number', $user->identification_number) }}" required />
                    <x-fields.input-field label="Código empleado (opcional)" name="employee_id" value="{{ old('employee_id', $user->employee_id) }}" />
                </div>

                {{-- Ubicación organizacional --}}
                <x-profile.profile-title icon="map-pin" title="Ubicación y dependencia" />
                <x-fields.branch-location-select
                    :branches="$branches->pluck('name', 'id')"
                    :branch-id="old('branch_id', $user->branch_id)"
                    :location-id="old('location_id', $user->location_id)"
                    :principal-id="1"
                    :alterna-id="2" />

                <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2">
                    <x-fields.input-field type="select" name="department_id" label="Área o dependencia" :options="$departments->pluck('name', 'id')" :value="old('department_id', $user->department_id)" />
                    <x-fields.input-field type="select" name="position_id" label="Cargo o función" :options="$positions->pluck('title', 'id')" :value="old('position_id', $user->position_id)" />
                </div>

                {{-- Estado de la cuenta --}}
                <x-profile.profile-title icon="calendar-check" title="Estado y vigencia" />
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-fields.input-field type="select" name="status" label="Estado de la cuenta"
                        :options="['activo' => 'Activo', 'inactivo' => 'Inactivo', 'suspendido' => 'Suspendido', 'eliminado' => 'Eliminado']"
                        :value="old('status', $user->status)" required />
                    <x-fields.input-field type="date" name="account_valid_from" label="Cuenta válida desde" value="{{ old('account_valid_from', optional($user->account_valid_from)->format('Y-m-d')) }}" />
                    <x-fields.input-field type="date" name="account_valid_until" label="Cuenta válida hasta" value="{{ old('account_valid_until', optional($user->account_valid_until)->format('Y-m-d')) }}" />
                </div>

                {{-- Consentimientos --}}
                <x-profile.profile-title check-circle title="Consentimientos de tratamiento de datos" />
                <div class="grid grid-cols-1 gap-4 text-sm text-gray-800 sm:grid-cols-2">
                    <x-fields.checkbox-field name="consent_data_processing" label="Acepta el tratamiento de datos personales" :checked="old('consent_data_processing', $user->consent_data_processing)" />
                    <x-fields.checkbox-field name="consent_marketing" label="Acepta recibir comunicaciones institucionales" :checked="old('consent_marketing', $user->consent_marketing)" />
                    <x-fields.checkbox-field name="consent_data_sharing" label="Autoriza compartir datos con terceros" :checked="old('consent_data_sharing', $user->consent_data_sharing)" />
                </div>

                {{-- Rol asignado --}}
                <x-profile.profile-title icon="shield" title="Rol asignado" />
                <div class="grid gap-4 sm:grid-cols-2">
                    @forelse($roles as $role)
                        <x-fields.radio-field name="role" :label="$role->name" :description="$role->description" :value="$role->name" :checked="$user->roles->first()?->name === $role->name" />
                    @empty
                        <p class="text-sm text-gray-500 col-span-full">No hay roles disponibles.</p>
                    @endforelse
                </div>

                {{-- Permisos individuales --}}
                <x-profile.profile-title icon="key" title="Permisos individuales" />
                <div class="grid gap-2 sm:grid-cols-2">
                    @forelse($permissions as $permission)
                        <x-fields.checkbox-field name="permissions[]" label="{{ $permission->name }}" value="{{ $permission->name }}" :checked="$user->hasPermissionTo($permission->name)" />
                    @empty
                        <p class="text-sm text-gray-500 col-span-full">No hay permisos disponibles.</p>
                    @endforelse
                </div>

                {{-- Acciones --}}
                <div class="flex items-center justify-start pt-4 space-x-4">
                    <x-buttons.primary-button>Guardar cambios</x-buttons.primary-button>
                    <a href="{{ route('admin.usuarios.index') }}" class="text-sm text-gray-600 underline hover:text-gray-800 focus-visible:outline focus-visible:ring focus-visible:ring-blue-500">
                        Cancelar
                    </a>
                </div>
            </form>
        </x-profile.section-card>
    </section>
</x-app-layout>

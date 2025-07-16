@php $editableRoles = $editableRoles ?? true; @endphp

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

    {{-- Nombres --}}
    <x-fields.input-field
        name="first_name"
        label="Nombres"
        required
        autocomplete="given-name"
        aria-required="true"
        :aria-invalid="$errors->has('first_name')"
        value="{{ old('first_name', $user->first_name ?? '') }}"
    />

    {{-- Apellidos --}}
    <x-fields.input-field
        name="last_name"
        label="Apellidos"
        required
        autocomplete="family-name"
        aria-required="true"
        :aria-invalid="$errors->has('last_name')"
        value="{{ old('last_name', $user->last_name ?? '') }}"
    />

    {{-- Tipo de Documento --}}
    <x-fields.autocomplete-select
        name="document_type"
        label="Tipo de Documento"
        :options="['CC' => 'Cédula de ciudadanía', 'TI' => 'Tarjeta de identidad', 'CE' => 'Cédula de extranjería', 'NIT' => 'NIT', 'PAS' => 'Pasaporte']"
        :value="strtoupper(old('document_type', $user->document_type ?? ''))"
        required
    />

    {{-- Número de Documento --}}
    <x-fields.input-field
        name="identification_number"
        label="Número de Documento"
        required
        aria-required="true"
        :aria-invalid="$errors->has('identification_number')"
        value="{{ old('identification_number', $user->identification_number ?? '') }}"
    />

    {{-- Correo institucional --}}
    <x-fields.input-field
        name="institutional_email"
        label="Correo institucional"
        type="email"
        required
        autocomplete="email"
        aria-required="true"
        :aria-invalid="$errors->has('institutional_email')"
        value="{{ old('institutional_email', $user->institutional_email ?? '') }}"
    />

    {{-- Correo personal --}}
    <x-fields.input-field
        name="personal_email"
        label="Correo personal"
        type="email"
        autocomplete="email"
        :aria-invalid="$errors->has('personal_email')"
        value="{{ old('personal_email', $user->personal_email ?? '') }}"
    />

    {{-- Contraseña --}}
    <x-fields.input-field
        name="password"
        label="Contraseña"
        type="password"
        :required="!isset($user->id)"
        autocomplete="new-password"
        aria-required="true"
        :aria-invalid="$errors->has('password')"
    />

    {{-- Confirmar Contraseña --}}
    <x-fields.input-field
        name="password_confirmation"
        label="Confirmar Contraseña"
        type="password"
        :required="!isset($user->id)"
        autocomplete="new-password"
        aria-required="true"
        :aria-invalid="$errors->has('password_confirmation')"
    />

    {{-- Dependencia --}}
    <x-fields.autocomplete-select
        name="department_id"
        label="Dependencia"
        :options="$departments->pluck('name', 'id')->toArray()"
        :value="(string) old('department_id', $user->department_id ?? '')"
        required
    />

    {{-- Cargo --}}
    <x-fields.autocomplete-select
        name="position_id"
        label="Cargo"
        :options="$positions->pluck('title', 'id')->toArray()"
        :value="(string) old('position_id', $user->position_id ?? '')"
        required
    />

    {{-- Sede y ubicación interna --}}
    <div class="col-span-full">
        <x-fields.branch-location-select
            :branch-id="old('branch_id', $user->branch_id ?? '')"
            :location-id="old('location_id', $user->location_id ?? '')"
            :branches="$branches"
        />
    </div>

    {{-- Rol con ayuda contextual --}}
    @if ($editableRoles)
        <x-fields.autocomplete-select
            name="role"
            label="Rol del Usuario"
            :options="$roles->pluck('name', 'name')->toArray()"
            :value="old('role', $user->roles->first()->name ?? '')"
            required
        >
            <x-slot name="suffix">
                <x-fields.help-icon title="El rol define qué puede hacer el usuario. Ejemplo: Administrador (gestiona todo), Instructor (formación), Apoyo (inventario/soporte)." />
            </x-slot>
        </x-fields.autocomplete-select>
    @else
        <input type="hidden" name="role" value="{{ $roles->first()->name }}">
    @endif

</div>

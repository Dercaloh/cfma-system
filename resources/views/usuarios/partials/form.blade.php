{{-- resources/views/usuarios/partials/form.blade.php --}}
@php $editableRoles = $editableRoles ?? true; @endphp

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

    {{-- Nombres y Apellidos --}}
    <x-fields.input-field name="first_name" label="Nombres" required value="{{ old('first_name', $user->first_name ?? '') }}" />
    <x-fields.input-field name="last_name" label="Apellidos" required value="{{ old('last_name', $user->last_name ?? '') }}" />

    {{-- Correo y Contraseña --}}
    <x-fields.input-field name="email" label="Correo electrónico" type="email" required value="{{ old('email', $user->email ?? '') }}" />
    <x-fields.input-field name="password" label="Contraseña" type="password" :required="!isset($user)" />
    <x-fields.input-field name="password_confirmation" label="Confirmar Contraseña" type="password" :required="!isset($user)" />

    {{-- Dependencia --}}
    <x-fields.input-field
        type="select"
        name="department_id"
        label="Dependencia"
        :options="$departments->pluck('name','id')"
        :value="old('department_id', $user->department_id ?? '')"
    />

    {{-- Sede (branch_id) --}}
    <x-fields.input-field
        type="select"
        name="branch_id"
        label="Sede Principal"
        :options="$branches->pluck('name','id')"
        :value="old('branch_id', $user->branch_id ?? '')"
        id="branch-select"
    />

    {{-- Ubicación (location_id) --}}
    <x-fields.input-field
        type="select"
        name="location_id"
        label="Ubicación Interna"
        :options="[]"
        :value="old('location_id', $user->location_id ?? '')"
        id="location-select"
    />

    {{-- Cargo --}}
    <x-fields.input-field
        type="select"
        name="job_title"
        label="Cargo"
        :options="$positions->pluck('title','title')"
        :value="old('job_title', $user->job_title ?? '')"
    />

    {{-- Rol --}}
    @if($editableRoles)
        <x-fields.input-field
            type="select"
            name="role"
            label="Rol del Usuario"
            :options="$roles->pluck('name','name')"
            :value="old('role', $user->roles->first()->name ?? '')"
            required
        />
    @else
        <input type="hidden" name="role" value="{{ $roles->first()->name }}">
    @endif
</div>

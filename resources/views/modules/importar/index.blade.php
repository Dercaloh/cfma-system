@extends('layouts.app')

@section('title', 'Importar usuarios desde Excel')

@section('content')
<div class="max-w-5xl p-6 mx-auto bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-200">
    <h1 class="mb-4 text-2xl font-bold">Importación masiva de usuarios</h1>

    {{-- Instrucciones accesibles --}}
    <x-profile.import-instructions />

    {{-- Formulario de carga --}}
    <form action="{{ route('admin.usuarios.importar.preview') }}" method="POST" enctype="multipart/form-data" aria-describedby="import-help" class="space-y-6">
        @csrf

        {{-- Archivo Excel --}}
        <x-fields.input-field
            label="Archivo Excel (.xlsx)"
            name="archivo"
            type="file"
            accept=".xlsx"
            help="El archivo no debe superar los 10MB. Asegúrate de usar la plantilla oficial."
            required
        />

        {{-- Selección de rol por defecto --}}
        <x-fields.select-field
            label="Rol por defecto"
            name="default_role"
            :options="$roles"
            help="Este rol se asignará a todos los usuarios nuevos si no se especifica uno individual."
            required
        />

        {{-- Ubicación predeterminada (opcional) --}}
        <x-fields.branch-location-select
            :branches="$branches"
            :departments="$departments"
            :locations="$locations"
        />

        {{-- Opciones adicionales --}}
        <div class="flex items-center gap-4">
            <x-fields.checkbox-accessible name="enviar_notificaciones" label="Enviar notificación a usuarios nuevos" />
            <x-fields.checkbox-accessible name="sobrescribir_existentes" label="Sobrescribir si el usuario ya existe" />
        </div>

        {{-- Botones --}}
        <div class="flex items-center justify-between pt-6 border-t dark:border-gray-700">
            <x-buttons.primary-button type="submit" icon="heroicon-o-eye" label="Vista previa" />
            <a href="{{ route('admin.usuarios.importar.history') }}" class="text-sm text-blue-600 hover:underline">Ver historial de importaciones</a>
        </div>
    </form>
</div>
@endsection

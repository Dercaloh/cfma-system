<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Registrar Usuario</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <form method="POST" action="{{ route('usuarios.store') }}" class="p-6 space-y-6 bg-white rounded shadow-md">
            @csrf

            <x-fields.input-field name="first_name" label="Nombres" required />
            <x-fields.input-field name="last_name" label="Apellidos" required />
            <x-fields.input-field name="email" label="Correo electrónico" type="email" required />
            <x-fields.input-field name="password" label="Contraseña" type="password" required />
            <x-fields.input-field name="password_confirmation" label="Confirmar Contraseña" type="password" required />

            <x-fields.select-field name="department_id" label="Dependencia">
                <option value="">Seleccione...</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </x-fields.select-field>

            <x-fields.select-field name="location_id" label="Sede">
                <option value="">Seleccione...</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </x-fields.select-field>

            <x-fields.select-field name="role" label="Rol del Usuario" required>
                <option value="">Seleccione...</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </x-fields.select-field>

            <x-primary-button>Registrar Usuario</x-primary-button>
        </form>
    </div>
</x-app-layout>

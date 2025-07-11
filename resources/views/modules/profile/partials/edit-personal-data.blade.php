<form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
    @csrf
    @method('PATCH')

    <div class="grid gap-4 sm:grid-cols-2">
        <x-profile.input-field
            id="first_name"
            name="first_name"
            label="Nombres"
            :value="old('first_name', $user->first_name)"
            required
            autofocus
        />
        <x-profile.input-field
            id="last_name"
            name="last_name"
            label="Apellidos"
            :value="old('last_name', $user->last_name)"
            required
        />
    </div>

    <x-profile.input-field
        id="username"
        name="username"
        label="Usuario institucional"
        :value="old('username', $user->username)"
        required
    />

    <x-profile.input-field
        id="email"
        name="email"
        type="email"
        label="Correo electrónico"
        :value="old('email', $user->email)"
        required
    />

    <div class="flex items-center justify-between">
        <x-buttons.primary-button>Guardar cambios</x-buttons.primary-button>
        @if (session('status') === 'profile-updated')
            <p class="text-sm text-green-600">Guardado correctamente.</p>
        @endif
    </div>
</form>

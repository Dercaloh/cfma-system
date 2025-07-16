<form method="POST" action="{{ route('profile.password') }}" class="space-y-6">
    @csrf
    @method('PUT')

    <x-profile.input-field
        name="current_password"
        type="password"
        label="Contraseña actual"
        autocomplete="current-password"
    />

    <x-profile.input-field
        name="password"
        type="password"
        label="Nueva contraseña"
        autocomplete="new-password"
    />

    <x-profile.input-field
        name="password_confirmation"
        type="password"
        label="Confirmar nueva contraseña"
        autocomplete="new-password"
    />

    <div class="flex items-center justify-between">
        <x-buttons.primary-button>Actualizar contraseña</x-buttons.primary-button>
        @if (session('status') === 'password-updated')
            <p class="text-sm text-green-600">Contraseña actualizada.</p>
        @endif
    </div>
</form>

<x-profile.section-card id="delete-account" class="mt-6">
    <x-profile-title>
        Eliminar Cuenta
    </x-profile-title>

    <div class="mb-4 text-sm text-gray-700">
        Esta acción eliminará permanentemente tu cuenta y todos los datos relacionados.
    </div>

    <!-- 🧾 Registro histórico de consentimiento -->
    @if($consent = $user->latestPolicy('tratamiento_datos'))
        <x-profile.consent-log :consent="$consent" />
    @endif

    <!-- 🔐 Formulario de eliminación -->
    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4 space-y-4">
        @csrf
        @method('DELETE')

        <x-fields.checkbox-field
            name="consent_data_processing"
            :checked="false"
            label="Confirmo nuevamente que acepto el tratamiento de mis datos personales según la Ley 1581 de 2012 y solicito la eliminación de mi cuenta."
            required
        />

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Contraseña</label>
            <x-text-input
                name="password"
                type="password"
                required
                class="w-full mt-1"
                autocomplete="current-password"
                placeholder="Confirma tu contraseña"
            />
            @error('password')
                <x-input-error :messages="$message" />
            @enderror
        </div>

        <div class="flex items-center justify-between mt-6">
            <x-buttons.danger-button>
                Eliminar cuenta
            </x-buttons.danger-button>

            @if (session('status') === 'account-deleted')
                <p class="text-sm text-red-600">
                    Cuenta eliminada correctamente.
                </p>
            @endif
        </div>
    </form>
</x-profile.section-card>

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nombre completo --}}
        <div>
            <x-input-label for="name" :value="__('Nombre completo')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Correo electrónico --}}
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Contraseña --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirmación --}}
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Consentimiento legal institucional --}}
        <x-fields.policy-consent-checkbox name="accept_terms" version="1.0.0" />

        {{-- Botón de registro --}}
        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 underline hover:text-gray-900">
                ¿Ya tienes cuenta?
            </a>

            <x-primary-button class="ms-4" id="submit-btn" disabled>
                Registrarme
            </x-primary-button>
        </div>
    </form>

    {{-- JS: Activar botón solo si se acepta política --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('accept_terms');
            const button = document.getElementById('submit-btn');

            if (checkbox && button) {
                checkbox.addEventListener('change', function () {
                    button.disabled = !this.checked;
                    button.classList.toggle('opacity-50', !this.checked);
                });
            }
        });
    </script>
</x-guest-layout>

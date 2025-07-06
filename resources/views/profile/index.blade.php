<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-sena-azul">
            {{ __('Perfil del Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#f6f6f6]">
        <div class="max-w-5xl px-4 mx-auto space-y-10">
            {{-- Encabezado de presentación con estado --}}
            <div class="p-6 bg-white shadow-md rounded-2xl">
                <div class="pb-6 mb-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h1 class="text-3xl font-bold text-gray-900 font-work-sans">Perfil de Usuario</h1>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $user->status === 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    <p class="mt-2 text-gray-600">Información personal y preferencias de seguridad</p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    {{-- Columna izquierda --}}
                    <div class="md:col-span-1">
                        <div class="p-6 bg-gray-50 rounded-xl">
                            <div class="flex justify-center mb-4">
                                <div class="flex items-center justify-center w-32 h-32 text-gray-400 bg-gray-200 border-2 border-dashed rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                            <h2 class="mb-2 text-xl font-semibold text-center">{{ $user->full_name }}</h2>
                            <p class="mb-4 text-center text-gray-600">{{ $user->email }}</p>

                            <div class="mt-6 space-y-3">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-gray-700">{{ $user->position->title ?? 'Sin cargo asignado' }}</span>
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-gray-700">{{ $user->location->name ?? 'Sin ubicación' }}</span>
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span class="text-gray-700">{{ $user->role->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Columna derecha con formularios --}}
                    <div class="space-y-10 md:col-span-2">
                        {{-- Información Personal --}}
                        <x-profile.section-card>
                            <x-profile.profile-title
                                icon="user"
                                title="Datos personales"
                                description="Modifica tu nombre, correo o identificación institucional." />
                            @include('profile.partials.edit-personal-data')
                        </x-profile.section-card>

                        {{-- Cambio de Contraseña --}}
                        <x-profile.section-card>
                            <x-profile.profile-title
                                icon="lock"
                                title="Seguridad de acceso"
                                description="Actualiza tu contraseña para mantener la seguridad de tu cuenta." />
                            @include('profile.partials.update-password')
                        </x-profile.section-card>

                        {{-- Configuración de Cuenta --}}
                        <x-profile.section-card>
                            <x-profile.profile-title
                                icon="settings"
                                title="Configuración de cuenta"
                                description="Elimina tu cuenta o actualiza tus consentimientos de tratamiento de datos." />
                            @include('profile.partials.account-settings')
                        </x-profile.section-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

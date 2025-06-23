<x-guest-layout>
    <div class="max-w-4xl mx-auto py-10 px-6 text-center">
        <h1 class="text-4xl font-bold text-green-700">Bienvenido al Sistema CFMA</h1>
        <p class="mt-4 text-gray-600">
            Esta aplicación web le permite gestionar el inventario y préstamo de activos tecnológicos del Centro de Formación Minero Ambiental del SENA.
        </p>

        <div class="mt-8 flex justify-center space-x-4">
            <a href="{{ route('login') }}"
               class="inline-block px-6 py-2 border border-green-700 bg-green-700 text-white rounded-lg hover:bg-green-800 transition">
                Iniciar sesión
            </a>
            <a href="{{ route('register') }}"
               class="inline-block px-6 py-2 border border-green-700 text-green-700 rounded-lg hover:bg-green-50 transition">
                Registrarse
            </a>
        </div>

        <div class="mt-10 text-sm text-gray-500">
            Desarrollado por el equipo TIC del CFMA – Regional Antioquia
        </div>
    </div>
</x-guest-layout>

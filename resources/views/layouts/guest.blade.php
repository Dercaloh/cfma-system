<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'SGPTI — SENA CFMA') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Tipografía institucional --}}
    <link rel="preload" as="font" href="{{ asset('fonts/WorkSans-Regular.ttf') }}" type="font/ttf" crossorigin>

    {{-- Estilos y scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Estilos adicionales --}}
    <link rel="stylesheet" href="{{ asset('css/sena.css') }}">
    @stack('styles')
</head>

<body class="font-sans antialiased text-gray-900 bg-gradient-to-br from-white via-white/60 to-white/40 backdrop-blur">

    {{-- Encabezado institucional --}}
    <header class="border-b shadow-md backdrop-blur bg-white/70 border-sena-verde/30">
        <div class="flex items-center justify-center px-6 py-4 mx-auto max-w-7xl">
            <div class="flex items-center gap-4">
                <img src="{{ asset('img/logo-sena-cfma.png') }}" alt="Logo SENA" class="w-auto h-14">
                <h1 class="text-xl font-bold text-sena-verde drop-shadow-sm">SGPTI — Gestión de Activos TI</h1>
            </div>
        </div>
    </header>

    {{-- Contenedor del formulario (Glass Card) --}}
    <main class="flex items-center justify-center min-h-screen px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md glass-card">
            {{ $slot }}
        </div>
    </main>

    {{-- Pie institucional --}}
    <footer class="mt-auto text-sm text-white shadow-inner bg-sena-azul backdrop-blur-md">
        <div class="px-6 py-5 mx-auto text-center max-w-7xl">
            <p class="font-semibold">Centro de Formación Minero Ambiental - SENA</p>
            <p class="mt-1 text-white/90">&copy; {{ date('Y') }} — Desarrollado por Harold Antonio Cordero Solera (Dercaloh)</p>
            <p class="text-white/70">Todos los derechos reservados</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

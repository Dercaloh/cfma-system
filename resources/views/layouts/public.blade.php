<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SGPTI — SENA CFMA')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Recursos principales via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Tipografía institucional --}}
    <link rel="preload" as="font" href="{{ asset('fonts/WorkSans-Regular.ttf') }}" type="font/ttf" crossorigin>

</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100">

    {{-- Contenido principal --}}
    <main class="container flex-grow px-4 py-6 mx-auto">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="py-4 mt-auto text-sm text-center text-white bg-sena-azul">
        <p class="font-semibold">Centro de Formación Minero Ambiental - SENA</p>
        <p class="text-white/80">&copy; {{ date('Y') }} — Desarrollado por Harold Antonio Cordero Solera</p>
    </footer>

    @stack('scripts')
</body>
</html>

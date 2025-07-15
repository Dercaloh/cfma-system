@props(['header'])

<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SGPTI — SENA CFMA')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @stack('styles')
</head>

<body
    class="flex flex-col min-h-screen font-sans text-gray-900 bg-gradient-to-br from-white via-white/70 to-white/50 backdrop-blur-xl">

    {{-- Encabezado institucional --}}
    <x-layout.header />

    {{-- Menú de navegación ya existente --}}
    <x-nav.nav-menu />

    {{-- Encabezado contextual --}}
    @if (!empty($header))
        {{ $header }}
    @endif


    {{-- Contenido dinámico --}}
    <main class="flex-grow px-6 py-8 mx-auto max-w-7xl">
        <x-security.watermark />
        {{ $slot }}
    </main>


    {{-- Pie institucional --}}
    <x-layout.footer />

    {{-- Marca de agua dinámica para desincentivar capturas --}}
    <x-security.watermark />

    @stack('scripts')
</body>

</html>

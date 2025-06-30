{{-- resources/views/layouts/app.blade.php --}}
@props(['header'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SGPTI — SENA CFMA')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Carga de recursos principales vía Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Tipografía institucional --}}
    <link rel="preload" as="font" href="{{ asset('fonts/WorkSans-Regular.ttf') }}" type="font/ttf" crossorigin>

    {{-- Estilos personalizados --}}
    <link rel="stylesheet" href="{{ asset('css/sena.css') }}">
    <link rel="stylesheet" href="{{ asset('css/prestamos.css') }}">
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col font-sans text-gray-900 bg-gradient-to-br from-white via-white/70 to-white/50 backdrop-blur-xl">

    {{-- Encabezado institucional con Glassmorphism --}}
    <header class="backdrop-blur bg-white/70 shadow-md border-b border-sena-verde/30">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img src="{{ asset('img/logo-sena-cfma.png') }}" alt="Logo SENA" class="h-14 w-auto">
                <h1 class="text-2xl font-extrabold text-sena-verde drop-shadow">SGPTI — Gestión de Activos TI</h1>
            </div>
        </div>
    </header>

    {{-- Barra de navegación institucional dinámica por rol --}}
    @auth
    <nav class="bg-sena-verde text-white shadow-sm backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center text-sm">
            <div class="flex flex-wrap gap-4 font-medium">
                <a href="{{ route('dashboard') }}" class="hover:underline">Inicio</a>
                <a href="{{ route('profile.edit') }}" class="hover:underline">Perfil</a>

                @php $role = Auth::user()->role->name ?? ''; @endphp

                @if ($role === 'administrador')
                    <a href="{{ route('inventario.index') }}" class="hover:underline">Inventario</a>
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline">Panel Admin</a>
                @elseif ($role === 'subdirector')
                    <a href="{{ route('prestamos.aprobar') }}" class="hover:underline">Aprobar Préstamos</a>
                @elseif ($role === 'supervisor')
                    <a href="{{ route('supervisor.dashboard') }}" class="hover:underline">Supervisión</a>
                @elseif ($role === 'portería')
                    <a href="{{ route('prestamos.checkin') }}" class="hover:underline">Check-In</a>
                    <a href="{{ route('prestamos.checkout') }}" class="hover:underline">Check-Out</a>
                @endif

                @if (in_array($role, ['administrador', 'subdirector', 'supervisor', 'instructor']))
                    <a href="{{ route('prestamos.index') }}" class="hover:underline">Préstamos</a>
                @endif
            </div>

            {{-- Usuario autenticado + logout --}}
            <div class="flex items-center gap-3 text-white/90">
                <span>{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-1 bg-white/10 hover:bg-white/20 border border-white/20 rounded text-xs">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    {{-- Encabezado contextual --}}
    @if (!empty($header))
        <section class="bg-white/60 backdrop-blur-md border-b border-sena-verde/20 shadow-inner">
            <div class="max-w-7xl mx-auto px-6 py-6">
                {{ $header }}
            </div>
        </section>
    @endif

    {{-- Contenido principal dinámico --}}
    <main class="max-w-7xl mx-auto px-6 py-8 flex-grow">
        {{ $slot }}
    </main>

    {{-- Pie institucional --}}
    <footer class="bg-sena-azul text-white text-sm mt-auto shadow-inner backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 py-5 text-center">
            <p class="font-semibold">Centro de Formación Minero Ambiental - SENA</p>
            <p class="mt-1 text-white/90">&copy; {{ date('Y') }} — Desarrollado por Harold Antonio Cordero Solera (Dercaloh)</p>
            <p class="text-white/70">Todos los derechos reservados</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

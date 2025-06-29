{{-- resources/views/layouts/app.blade.php --}}
@props(['header'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SGPTI — SENA CFMA')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white text-gray-900 font-sans min-h-screen flex flex-col">

    {{-- Encabezado Institucional --}}
    <header class="bg-white shadow py-4">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/logo-sena.png') }}" alt="Logo SENA" class="h-14 w-auto">
                <h1 class="text-2xl font-bold text-green-700">Sistema de Gestión de TI</h1>
            </div>
        </div>
    </header>

    {{-- Barra de navegación --}}
    @auth
    <nav class="bg-green-700 text-white py-3 shadow-sm">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex space-x-6">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <a href="{{ route('profile.edit') }}">Perfil</a>

                @php $role = Auth::user()->role->name; @endphp

                @if ($role === 'administrador')
                    <a href="{{ route('inventario.index') }}">Inventario</a>
                    <a href="{{ route('admin.dashboard') }}">Panel Admin</a>
                @elseif ($role === 'subdirector')
                    <a href="{{ route('prestamos.aprobar') }}">Aprobar Préstamos</a>
                @elseif ($role === 'supervisor')
                    <a href="{{ route('supervisor.dashboard') }}">Supervisión</a>
                @elseif ($role === 'portería')
                    <a href="{{ route('prestamos.checkin') }}">Check-In</a>
                    <a href="{{ route('prestamos.checkout') }}">Check-Out</a>
                @endif

                @if (in_array($role, ['administrador', 'subdirector', 'supervisor', 'instructor']))
                    <a href="{{ route('prestamos.index') }}">Préstamos</a>
                @endif
            </div>

            <div class="flex items-center space-x-3">
                <span class="font-medium">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    {{-- Header contextual desde <x-slot name="header"> --}}
    @if (!empty($header))
        <header class="bg-gray-100 shadow-inner">
            <div class="container mx-auto px-4 py-6">
                {{ $header }}
            </div>
        </header>
    @endif

    {{-- Contenido dinámico --}}
    <main class="container mx-auto px-4 py-8 flex-grow" role="main">
        {{ $slot }}
    </main>

    {{-- Pie de página --}}
    <footer class="bg-sena-azul text-white text-sm mt-auto">
        <div class="container mx-auto px-4 py-6 text-center">
            <p class="font-semibold">Centro de Formación Minero Ambiental - SENA</p>
            <p class="mt-1 text-white/90">
                &copy; {{ date('Y') }} — Desarrollado por Harold Antonio Cordero Solera (Dercaloh)
            </p>
            <p class="text-white/70">Todos los derechos reservados</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

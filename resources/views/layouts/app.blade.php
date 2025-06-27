@props(['header' => null])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CFMA') — Sistema de Gestión</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="bg-white text-sena-azul font-sans leading-relaxed min-h-screen flex flex-col">

    {{-- Encabezado institucional --}}
    <header class="bg-white shadow py-4" role="banner">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/logo-sena.png') }}" alt="Logo SENA" class="h-14 w-auto">
                <h1 class="text-2xl font-bold text-green-700">
                    Sistema de Gestión de TI
                </h1>
            </div>
        </div>
    </header>

    {{-- Navegación según rol --}}
    @auth
    <nav class="bg-green-700 text-white py-3 shadow-sm" role="navigation">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-6">

                <a href="{{ route('dashboard') }}" class="hover:underline font-semibold">Inicio</a>
                <a href="{{ route('profile.edit') }}" class="hover:underline">Perfil</a>

                {{-- Enlaces específicos por rol --}}
                @php
                    $role = Auth::user()->role->name;
                @endphp

                @if ($role === 'administrador')
                    <a href="{{ route('inventario.index') }}" class="hover:underline">Inventario</a>
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline">Panel Admin</a>
                @elseif ($role === 'subdirector')
                    <a href="{{ route('prestamos.aprobar') }}" class="hover:underline">Aprobar Préstamos</a>
                @elseif ($role === 'supervisor')
                    <a href="{{ route('supervisor.dashboard') }}" class="hover:underline">Supervisión</a>
                @elseif ($role === 'instructor')
                    <a href="{{ route('prestamos.solicitar') }}" class="hover:underline">Solicitar Préstamo</a>
                @elseif ($role === 'portería')
                    <a href="{{ route('prestamos.checkin') }}" class="hover:underline">Check-In</a>
                    <a href="{{ route('prestamos.checkout') }}" class="hover:underline">Check-Out</a>
                @endif

            </div>

            {{-- Usuario + Logout --}}
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

    {{-- Header contextual opcional --}}
    @if ($header)
        <header class="bg-gray-100 shadow-inner">
            <div class="container mx-auto px-4 py-6">
                {{ $header }}
            </div>
        </header>
    @endif

    {{-- Contenido principal --}}
    <main class="container mx-auto px-4 py-8 flex-grow" role="main">
        {{ $slot }}
    </main>

    {{-- Footer institucional --}}
    <footer class="bg-sena-azul text-white text-sm mt-auto" role="contentinfo">
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

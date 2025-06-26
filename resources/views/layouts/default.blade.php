{{-- resources/views/layouts/default.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CFMA') — Sistema de Gestión</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-sena-gris text-sena-azul font-sans leading-relaxed min-h-screen flex flex-col">

    {{-- Header institucional --}}
    <header class="bg-white shadow py-4">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/logo-sena.png') }}" alt="Logo SENA" class="h-12">
                <h1 class="text-xl font-bold text-sena-verde">Sistema de Gestión CFMA</h1>
            </div>
        </div>
    </header>

    {{-- Navegación contextual --}}
    @auth
    <nav class="bg-sena-verde text-white py-3 shadow" role="navigation">
        <div class="container mx-auto px-4 flex justify-between items-center">
        {{-- Enlaces del menú --}}
            <div class="flex space-x-6 font-semibold">
                <a href="{{ route('dashboard') }}" class="hover:text-sena-gris transition">Inicio</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-sena-gris transition">Perfil</a>

                @php $rol = Auth::user()->role->name; @endphp

                @if ($rol === 'administrador')
                    <a href="{{ route('inventario.index') }}" class="hover:text-sena-gris transition">Inventario</a>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-sena-gris transition">Admin</a>
                @elseif ($rol === 'supervisor')
                    <a href="{{ route('supervisor.dashboard') }}" class="hover:text-sena-gris transition">Supervisor</a>
                @elseif ($rol === 'subdirector')
                    <a href="{{ route('prestamos.aprobar') }}" class="hover:text-sena-gris transition">Aprobar</a>
                @elseif ($rol === 'instructor')
                    <a href="{{ route('prestamos.solicitar') }}" class="hover:text-sena-gris transition">Solicitar</a>
                @elseif ($rol === 'portería')
                    <a href="{{ route('prestamos.checkin') }}" class="hover:text-sena-gris transition">Check-In</a>
                    <a href="{{ route('prestamos.checkout') }}" class="hover:text-sena-gris transition">Check-Out</a>
                @endif
        </div>

        {{-- Usuario + Logout --}}
        <div class="flex items-center space-x-2">
            <span class="font-medium">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm bg-red-600 hover:bg-red-700 px-2 py-1 rounded">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</nav>

    @endauth

    {{-- Contenido principal --}}
    <main class="container mx-auto px-4 py-6 flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-sena-azul text-white text-sm py-4 text-center mt-auto">
        <p class="font-semibold">Centro de Formación Minero Ambiental - SENA</p>
        <p class="text-white/80">&copy; {{ date('Y') }} — Desarrollado por Harold Antonio Cordero Solera</p>
    </footer>

    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - CFMA</title>

    {{-- CSS institucional y tipografía --}}
    <link rel="stylesheet" href="{{ asset('css/sena.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Work Sans', Calibri, Arial, sans-serif;
        }
        h1, h2, h3 {
            font-weight: 600;
        }
        .bg-sena-verde {
            background-color: var(--sena-verde-principal);
        }
        .bg-sena-azul {
            background-color: var(--sena-azul);
        }
        .text-white {
            color: var(--sena-blanco);
        }
    </style>
</head>
<body>
    <header class="bg-sena-verde text-white" role="banner">
        <div class="container d-flex align-items-center gap-3">
            <img src="{{ asset('img/logo-sena.png') }}" alt="Logo SENA" height="60">
            <h1 class="m-0">Sistema de Gestión de Activos - CFMA</h1>
        </div>
    </header>

    <main role="main" class="container py-4">
        @yield('content')
    </main>

    <footer class="bg-sena-azul text-white" role="contentinfo">
        <div class="container text-center py-3">
            <p>Centro de Formación Minero Ambiental - SENA</p>
            <p>&copy; {{ date('Y') }} - Desarrollado por Harold Antonio Cordero Solera (Dercaloh) - Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>

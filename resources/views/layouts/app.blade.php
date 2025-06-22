<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - CFMA</title>
    <link rel="stylesheet" href="{{ asset('css/sena.css') }}">
</head>
<body>
    <header style="background: #39A900;">
        <div class="container">
            <img src="{{ asset('img/logo-sena.png') }}" alt="Logo SENA" height="60">
            <h1>Sistema de Gestión de Activos - CFMA</h1>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer style="background: #00304D; color: white;">
        <div class="container">
            <p>Centro de Formación Minero Ambiental - SENA</p>
            <p>© {{ date('Y') }} - Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>

{{-- resources/views/actas/gate.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: system-ui, sans-serif; font-size: 14px; }
        table { width: 100%; margin-top: 1em; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 8px; }
        .title { text-align: center; font-weight: bold; font-size: 18px; }
    </style>
</head>
<body>
    <p class="title">Acta de {{ ucfirst($log->action) }} de Activo</p>
    <table>
        <tr><th>Responsable</th><td>{{ $log->user->name }}</td></tr>
        <tr><th>Fecha y Hora</th><td>{{ $log->logged_at }}</td></tr>
        <tr><th>Activo</th><td>{{ $log->asset->serial_number }} - {{ $log->asset->type }}</td></tr>
        <tr><th>Notas</th><td>{{ $log->notes ?? '---' }}</td></tr>
    </table>
    <p style="margin-top: 50px;">Firma: _____________________________</p>
</body>
</html>

{{-- resources/views/exit_passes/template.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acta de Salida de Equipos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #000; }
        .header { text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 10px; }
        .section { margin-bottom: 10px; }
        .section-title { font-weight: bold; text-decoration: underline; margin-bottom: 4px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table td, .table th { border: 1px solid #000; padding: 4px; }
        .firmas td { height: 60px; vertical-align: bottom; }
        .footer { margin-top: 40px; font-size: 10px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">SENA - Centro de Formación Minero Ambiental<br>Autorización de Salida de Equipos</div>

    <div class="section">
        <div class="section-title">Datos del Responsable</div>
        <p><strong>Nombre:</strong> {{ $exitPass->cuentadante }}</p>
        <p><strong>Cédula:</strong> {{ $exitPass->cedula }}</p>
        <p><strong>Dependencia:</strong> {{ $exitPass->dependencia }}</p>
    </div>

    <div class="section">
        <div class="section-title">Detalles de la Salida</div>
        <p><strong>Fecha autorizada de salida:</strong> {{ $exitPass->autorizado_salida }}</p>
        <p><strong>Fecha autorizada de regreso:</strong> {{ $exitPass->autorizado_regreso ?? '---' }}</p>
        <p><strong>Tipo de permiso:</strong> {{ ucfirst($exitPass->permiso) }}</p>
    </div>

    <div class="section">
        <div class="section-title">Activo Asociado</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $exitPass->gateLog->asset->serial_number }}</td>
                    <td>{{ $exitPass->gateLog->asset->type }}</td>
                    <td>{{ $exitPass->gateLog->notes }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <table class="table firmas">
            <tr>
                <td><strong>Firma Responsable</strong></td>
                <td><strong>Autorizado por</strong></td>
            </tr>
            <tr>
                <td>___________________________</td>
                <td>{{ $exitPass->firmado_por ?? '___________________________' }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Documento generado automáticamente desde el sistema de gestión CFMA - {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>

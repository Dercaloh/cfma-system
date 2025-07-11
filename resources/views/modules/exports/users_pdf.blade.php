<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios - SGPTI</title>
    <style>
        body {
            font-family: 'Calibri', sans-serif;
            font-size: 12px;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #39A900;
            color: white;
            padding: 6px;
            font-size: 12px;
        }
        td {
            padding: 6px;
            font-size: 11px;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
        }
        .badge {
            background-color: #FDC300;
            color: #000;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #555;
            border-top: 1px solid #CCC;
            padding-top: 10px;
        }
        .legal-notice {
            font-size: 9.5px;
            margin-top: 20px;
            line-height: 1.4;
            text-align: justify;
            color: #555;
        }
    </style>
</head>
<body>

    {{-- Portada institucional --}}
    @include('components.pdf_cover', [
        'classification' => $classification ?? 'Pública Clasificada',
        'process' => 'GESTIÓN DEL TALENTO HUMANO',
        'format_name' => 'REPORTE DE ROLES Y PERMISOS DEL SGPTI',
        'document_title' => 'Listado oficial de usuarios activos del sistema SGPTI'
    ])

    {{-- Título del informe --}}
    <h2 style="text-align: center; margin-bottom: 12px;">Usuarios activos con roles y permisos asignados</h2>

    {{-- Tabla de usuarios --}}
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Documento</th>
                <th>Cargo</th>
                <th>Área</th>
                <th>Ubicación</th>
                <th>Roles</th>
                <th>Permisos</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->employee_id ?? 'No registrado' }}</td>
                    <td>{{ $user->job_title ?? 'Sin asignar' }}</td>
                    <td>{{ $user->department?->name ?? 'Sin asignar' }}</td>
                    <td>{{ $user->location?->name ?? 'Sin asignar' }}</td>
                    <td>
                        @if($user->roles->isEmpty())
                            <span class="badge">Sin rol</span>
                        @else
                            <ul>
                                @foreach($user->roles as $role)
                                    <li>{{ $role->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>
                        @if($user->permissions->isEmpty())
                            <span class="badge">Sin permisos</span>
                        @else
                            <ul>
                                @foreach($user->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; font-style: italic;">No hay usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Metadatos de exportación --}}
    <div class="footer">
        Exportado por: {{ $exported_by }} <br>
        Dirección IP: {{ $ip_address }} <br>
        Fecha y hora: {{ $export_date }}
    </div>

    {{-- Leyenda legal --}}
    <div class="legal-notice">
        Este documento ha sido generado automáticamente desde el SGPTI – CFMA SENA.
        Su contenido está clasificado como <strong>{{ ucfirst($classification ?? 'Pública') }}</strong>, según la Guía GOR-G-015 del Sistema Integrado de Gestión y Autocontrol.
        Su tratamiento se realiza conforme a la Ley 1581 de 2012, Ley 1712 de 2014 y la norma ISO 27001. Su uso indebido puede generar sanciones legales.
    </div>

</body>
</html>

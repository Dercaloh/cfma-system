@props([
    'classification' => 'Pública Clasificada',
    'process' => 'GESTIÓN ORGANIZACIONAL Y DEL RIESGO',
    'format_name' => 'PLANTILLA DOCUMENTOS Y FORMATOS EN WORD SISTEMA INTEGRADO DE GESTIÓN Y AUTOCONTROL',
    'document_title' => 'REPORTE GENERAL DE USUARIOS CON ROLES ASIGNADOS'
])

@php
    use Carbon\Carbon;
    Carbon::setLocale('es');
    $monthYear = ucfirst(Carbon::now()->isoFormat('MMMM [de] YYYY'));

    $isPublica = strtolower($classification) === 'pública';
    $isClasificada = strtolower($classification) === 'pública clasificada';
    $isReservada = strtolower($classification) === 'pública reservada';
@endphp

<style>
    .cover-page {
        font-family: 'Calibri', sans-serif;
        text-align: center;
        padding-top: 30px;
        color: #000;
        page-break-after: always;
    }

    .cover-table {
        width: 75%;
        margin: 0 auto 30px;
        border-collapse: collapse;
        font-size: 12pt;
    }

    .cover-table th,
    .cover-table td {
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
    }

    .header {
        background-color: #000;
        color: #FFF;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12pt;
    }

    .value {
        background-color: #FFF;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12pt;
    }

    .classification td {
        background-color: #FFF;
        font-weight: normal;
        text-transform: capitalize;
        font-size: 12pt;
        text-align: center;
        vertical-align: middle;
    }

    .checkbox {
        display: inline-block;
        width: 12px;
        height: 12px;
        border: 1px solid #000;
        margin-left: 6px;
        text-align: center;
        font-size: 11px;
        font-weight: bold;
        line-height: 12px;
        vertical-align: middle;
    }

    .footer-legal {
        font-size: 11px;
        color: #555;
        font-family: 'Calibri', sans-serif;
        margin-top: 60px;
    }
</style>

<div class="cover-page">
    {{-- Encabezado gráfico institucional --}}
    <div style="margin-bottom: 30px;">
        <img src="{{ public_path('img/Logosimbolo-SENA-PRINCIPAL.png') }}" alt="Logo SENA" height="85">
    </div>

    {{-- Tabla de portada --}}
    <table class="cover-table">
        <tr><td class="header" colspan="3">PROCESO</td></tr>
        <tr><td class="value" colspan="3">{{ strtoupper($process) }}</td></tr>
        <tr><td class="header" colspan="3">NOMBRE DEL FORMATO</td></tr>
        <tr><td class="value" colspan="3">{{ strtoupper($format_name) }}</td></tr>
        <tr><td class="header" colspan="3">CLASIFICACIÓN DE LA INFORMACIÓN</td></tr>
        <tr class="classification">
            <td>
                Pública <span class="checkbox">{{ $isPublica ? 'X' : '' }}</span>
            </td>
            <td>
                Pública Clasificada <span class="checkbox">{{ $isClasificada ? 'X' : '' }}</span>
            </td>
            <td>
                Pública Reservada <span class="checkbox">{{ $isReservada ? 'X' : '' }}</span>
            </td>
        </tr>
    </table>

    {{-- Título y fecha --}}
    <div>
        <div style="font-size: 15px; font-weight: bold; text-transform: uppercase;">
            {{ strtoupper($document_title) }}
        </div>
        <div style="margin-top: 10px; font-size: 13px;">
            {{ $monthYear }}
        </div>
    </div>

    {{-- Pie gráfico --}}
    <div style="margin-top: 50px;">
        <img src="{{ public_path('img/Redes-sociales.png') }}" alt="Redes Sociales SENA" height="50">
    </div>

    {{-- Nota legal --}}
    <div class="footer-legal">
        Clasificación según Guía GOR-G-015. Plantilla oficial GOR-F-012 V03 – Sistema Integrado de Gestión y Autocontrol – CFMA SENA.
    </div>
</div>

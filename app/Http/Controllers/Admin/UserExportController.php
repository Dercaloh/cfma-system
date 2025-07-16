<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersBackupExport;

class UserExportController extends Controller
{
    public function __construct()
    {
        // Middleware para controlar permisos (ajustar según política)
        $this->middleware('can:exportar usuarios');
    }

    public function export(Request $request)
    {
        $validated = $request->validate([
            'format' => ['required', 'in:xlsx,csv'],
            'classification' => ['nullable', 'string'],
        ]);

        $format = $validated['format'];
        $classification = $validated['classification'] ?? 'Pública Clasificada';

        $timestamp = now()->format('Ymd_His');
        $fileName = "usuarios_backup_{$timestamp}.{$format}";

        $exportedBy = Auth::user()?->full_name ?? 'Administrador SGPTI';
        $ipAddress = $request->ip();

        // Auditoría
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                'export_format' => $format,
                'classification' => $classification,
                'user_count' => 'Todos',
                'ip_address' => $ipAddress,
            ])
            ->log("Exportó usuarios para backup (formato: $format, clasificación: $classification)");

        $export = new UsersBackupExport();

        $writerType = $format === 'csv'
            ? \Maatwebsite\Excel\Excel::CSV
            : \Maatwebsite\Excel\Excel::XLSX;

        return Excel::download($export, $fileName, $writerType);
    }
}

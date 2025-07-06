<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\UsersCurrentPageExport;

class UserExportController extends Controller
{
    public function export(Request $request)
    {
        $type = $request->input('type', 'current');
        $format = $request->input('format', 'xlsx');
        $userIds = $request->input('user_ids', []);
        $classification = $request->input('classification', 'Pública Clasificada');

        $timestamp = now()->format('Ymd_His');
        $fileName = "usuarios_{$type}_{$timestamp}.{$format}";

        $exportedBy = Auth::user()?->full_name ?? 'Administrador SGPTI';
        $ipAddress = $request->ip();
        $exportDate = now()->format('d/m/Y h:i A');

        // Auditoría
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                'export_type' => $type,
                'export_format' => $format,
                'classification' => $classification,
                'ip_address' => $ipAddress,
            ])
            ->log("Exportó usuarios, tipo: {$type}, formato: {$format}, clasificación: {$classification}");

        // Exportar a PDF
        if ($format === 'pdf') {
            $users = ($type === 'all')
                ? \App\Models\User::with(['roles', 'permissions', 'department', 'location'])->whereNull('deleted_at')->get()
                : \App\Models\User::with(['roles', 'permissions', 'department', 'location'])
                    ->whereIn('id', is_array($userIds) ? explode(',', implode(',', $userIds)) : [$userIds])
                    ->whereNull('deleted_at')->get();

            $pdf = Pdf::loadView('exports.users_pdf', [
                    'users' => $users,
                    'exported_by' => $exportedBy,
                    'ip_address' => $ipAddress,
                    'export_date' => $exportDate,
                    'classification' => $classification,
                ])
                ->setPaper('a4', 'landscape')
                ->setWarnings(false);

            // ✅ Metadatos obligatorios mediante add_info()
            $canvas = $pdf->getDomPDF()->getCanvas();
            $canvas->add_info('Title', 'Exportación de Usuarios - SGPTI');
            $canvas->add_info('Author', $exportedBy);
            $canvas->add_info('Subject', "Clasificación: $classification. Tratamiento conforme a la Ley 1581 y Acuerdo v1.0.0");
            $canvas->add_info('Creator', 'Sistema SGPTI – CFMA SENA');
            $canvas->add_info('Producer', 'DomPDF');
            $canvas->add_info('Keywords', "SGPTI, Usuarios, Exportación, Ley 1581, Ley 1712, ISO 27001, Clasificación: $classification");

            return $pdf->download($fileName);
        }

        // Exportar Excel o CSV
        $export = $type === 'all'
            ? new UsersExport($exportedBy, $ipAddress)
            : new UsersCurrentPageExport($userIds, $exportedBy, $ipAddress);

        return Excel::download(
            $export,
            $fileName,
            $format === 'csv'
                ? \Maatwebsite\Excel\Excel::CSV
                : \Maatwebsite\Excel\Excel::XLSX
        );
    }
}

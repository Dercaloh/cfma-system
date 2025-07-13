<?php
namespace App\Exports;

use App\Models\Users\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

class UsersExport implements FromCollection, WithHeadings, WithProperties, WithCustomStartCell, WithEvents
{
    protected string $exportedBy;
    protected string $ipAddress;

    public function __construct(string $exportedBy, string $ipAddress)
    {
        $this->exportedBy = $exportedBy;
        $this->ipAddress = $ipAddress;
    }

    public function collection(): Collection
    {
        return User::with(['roles', 'permissions', 'department', 'location'])
            ->whereNull('deleted_at')
            ->get()
            ->map(fn($user) => [
                'Nombre' => $user->full_name,
                'Correo' => $user->email,
                'Documento' => $user->employee_id ?? 'N/A',
                'Cargo' => $user->job_title ?? 'N/A',
                'Área' => $user->department?->name ?? 'N/A',
                'Ubicación' => $user->location?->name ?? 'N/A',
                'Roles' => $user->roles->pluck('name')->implode(', '),
                'Permisos' => $user->permissions->pluck('name')->implode(', '),
            ]);
    }

    public function headings(): array
    {
        return ['Nombre', 'Correo', 'Documento', 'Cargo', 'Área', 'Ubicación', 'Roles', 'Permisos'];
    }

    public function startCell(): string
    {
        return 'A9';
    }

    public function properties(): array
    {
        return [
            'creator' => $this->exportedBy,
            'lastModifiedBy' => 'SGPTI - CFMA SENA',
            'title' => 'Exportación de Usuarios',
            'description' => 'Exportación conforme a Ley 1581 y Acuerdo v1.0.0',
            'subject' => 'Trazabilidad de usuarios SGPTI',
            'keywords' => 'SGPTI, Usuarios, Exportación, Ley 1581, Ley 1712, ISO 27001, SENA',
            'category' => 'Gestión de Información',
            'company' => 'Centro de Formación Minero Ambiental – SENA',
            'manager' => 'Coordinador TIC',
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => fn($event) => $event->sheet->appendRows([
                ['Sistema de Gestión de Préstamos e Inventario de Activos de TI – SGPTI'],
                ['Centro de Formación Minero Ambiental – SENA'],
                ['Responsable del tratamiento: SENA – NIT 899.999.034-1'],
                ['Contacto: servicioalciudadano@sena.edu.co'],
                ['Exportado por: ' . $this->exportedBy],
                ['Fecha: ' . now()->format('d/m/Y h:i A')],
                ['IP: ' . $this->ipAddress],
                ['Este archivo se rige por el Acuerdo de Tratamiento de Datos Personales v1.0.0'],
                [''],
            ], null, 'A1', false),
        ];
    }
}

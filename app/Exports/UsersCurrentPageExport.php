<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

class UsersCurrentPageExport implements
    FromCollection,
    WithHeadings,
    WithProperties,
    WithCustomStartCell,
    WithEvents
{
    protected array $userIds;
    protected string $exportedBy;
    protected string $ipAddress;

    public function __construct(array $userIds, string $exportedBy, string $ipAddress)
    {
        $this->userIds = $userIds;
        $this->exportedBy = $exportedBy;
        $this->ipAddress = $ipAddress;
    }

    public function collection(): Collection
    {
        return User::with(['roles', 'permissions', 'department', 'location'])
            ->whereIn('id', $this->userIds)
            ->get()
            ->map(function ($user) {
                return [
                    'Nombre'     => $user->full_name,
                    'Correo'     => $user->email,
                    'Documento'  => $user->employee_id ?? 'N/A',
                    'Cargo'      => $user->job_title ?? 'N/A',
                    'Área'       => $user->department?->name ?? 'N/A',
                    'Ubicación'  => $user->location?->name ?? 'N/A',
                    'Roles'      => $user->roles->pluck('name')->implode(', '),
                    'Permisos'   => $user->permissions->pluck('name')->implode(', '),
                ];
            });
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
            'creator'        => $this->exportedBy,
            'lastModifiedBy' => 'SGPTI - CFMA SENA',
            'title'          => 'Exportación Parcial de Usuarios',
            'description'    => 'Exportación conforme a la Ley 1581 y Acuerdo de Tratamiento de Datos v1.0.0',
            'subject'        => 'Trazabilidad de usuarios SGPTI',
            'keywords'       => 'SGPTI, Exportación, Usuarios, Ley 1581, SENA',
            'category'       => 'Gestión TIC',
            'company'        => 'Centro de Formación Minero Ambiental – SENA',
            'manager'        => 'Coordinador TIC',
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->sheet->appendRows([
                    ['Sistema de Gestión de Préstamos e Inventario de Activos de TI – SGPTI'],
                    ['Centro de Formación Minero Ambiental – SENA'],
                    ['Responsable del tratamiento: SENA – NIT 899.999.034-1'],
                    ['Contacto: servicioalciudadano@sena.edu.co'],
                    ['Exportado por: ' . $this->exportedBy],
                    ['Fecha: ' . now()->format('d/m/Y h:i A')],
                    ['IP: ' . $this->ipAddress],
                    ['Este archivo se rige por el Acuerdo de Tratamiento de Datos Personales v1.0.0'],
                    [''],
                ], null, 'A1', false);
            },
        ];
    }
}

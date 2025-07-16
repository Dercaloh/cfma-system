<?php
namespace App\Exports;

use App\Models\Users\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersCsvExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        return User::with(['roles', 'permissions', 'department', 'location'])
            ->get()
            ->map(fn($user) => [
                $user->full_name,
                $user->email,
                $user->employee_id ?? 'N/A',
                $user->job_title ?? 'N/A',
                $user->department?->name ?? 'N/A',
                $user->location?->name ?? 'N/A',
                $user->roles->pluck('name')->implode(', '),
                $user->permissions->pluck('name')->implode(', '),
            ]);
    }

    public function headings(): array
    {
        return ['Nombre', 'Correo', 'Documento', 'Cargo', 'Área', 'Ubicación', 'Roles', 'Permisos'];
    }
}

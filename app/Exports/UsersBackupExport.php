<?php

namespace App\Exports;

use App\Models\Users\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersBackupExport implements FromCollection, WithHeadings
{
    /**
     * Traer los usuarios sin consentimientos para respaldo/restauración.
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        return User::select([
            'id',
            'document_type',
            'first_name',
            'last_name',
            'username',
            'email',
            'identification_number',
            'employee_id',
            'position_id',
            'phone_number',
            'personal_email',
            'institutional_email',
            'department_id',
            'branch_id',
            'location_id',
            'status',
            'account_valid_from',
            'account_valid_until',
            'email_verified_at',
            'last_password_change_at',
            'last_login_at',
            'last_login_ip',
            'created_at',
            'updated_at',
            'deleted_at',
        ])
        ->get();
    }

    /**
     * Títulos de columnas para el Excel/CSV
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'document_type',
            'first_name',
            'last_name',
            'username',
            'email',
            'identification_number',
            'employee_id',
            'position_id',
            'phone_number',
            'personal_email',
            'institutional_email',
            'department_id',
            'branch_id',
            'location_id',
            'status',
            'account_valid_from',
            'account_valid_until',
            'email_verified_at',
            'last_password_change_at',
            'last_login_at',
            'last_login_ip',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }
}

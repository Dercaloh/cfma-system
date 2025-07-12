<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // La política ya controla el acceso en el controlador
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            // 📌 Datos personales
            'first_name'            => ['required', 'string', 'max:100'],
            'last_name'             => ['required', 'string', 'max:100'],
            'email'                 => ['required', 'email', 'max:150', "unique:users,email,{$userId}"],
            'username'              => ['required', 'string', 'max:50', "unique:users,username,{$userId}"],
            'document_type'         => ['required', 'in:CC,TI,CE,NIT,PAS'],
            'identification_number' => ['required', 'string', 'max:30', "unique:users,identification_number,{$userId}"],

            // 📍 Ubicación organizacional y cargo
            'branch_id'       => ['required', 'exists:branches,id'],
            'location_id'     => ['required', 'exists:locations,id'],
            'department_id'   => ['nullable', 'exists:departments,id'],
            'new_department'  => ['nullable', 'string', 'max:100'],
            'position_id'     => ['nullable', 'exists:positions,id'],
            'new_position'    => ['nullable', 'string', 'max:100'],
            'employee_id'     => ['nullable', 'string', 'max:50'],
            'phone_number'    => ['nullable', 'string', 'max:20'],
            'personal_email'  => ['nullable', 'email', 'max:100'],
            'institutional_email' => ['nullable', 'email', 'max:100'],

            // 📆 Estado y vigencia
            'status'              => ['required', 'in:activo,inactivo,suspendido,eliminado'],
            'account_valid_from'  => ['nullable', 'date'],
            'account_valid_until' => ['nullable', 'date', 'after_or_equal:account_valid_from'],

            // 🔐 Consentimientos
            'consent_data_processing' => ['nullable', 'boolean'],
            'consent_data_sharing'    => ['nullable', 'boolean'],
            'consent_marketing'       => ['nullable', 'boolean'],

            // 🔑 Roles y permisos
            'role'         => ['required', 'string', 'exists:roles,name'],
            'permissions'  => ['nullable', 'array'],
            'permissions.*'=> ['string', 'exists:permissions,name'],
        ];
    }

    public function messages(): array
    {
        return [
            // ⚠️ Mensajes personalizados
            'identification_number.unique' => 'Este número de documento ya está registrado.',
            'username.unique'              => 'Este nombre de usuario ya está en uso.',
            'email.unique'                 => 'Este correo electrónico ya está registrado.',
            'account_valid_until.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'role.required'               => 'Debe seleccionar un rol para el usuario.',
        ];
    }
}

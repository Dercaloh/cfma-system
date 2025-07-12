<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    /**
     * Verifica si el usuario puede realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return $this->user()?->hasRole('Administrador');
    }

    /**
     * Reglas de validación para registrar un nuevo usuario.
     */
    public function rules(): array
    {
        return [
            // Información personal
            'first_name'           => ['required', 'string', 'max:50'],
            'last_name'            => ['required', 'string', 'max:50'],

            // Identificación
            'document_type'        => ['required', 'in:CC,TI,CE,PA,NIT'],
            'identification_number'=> ['required', 'string', 'max:20', 'unique:users,identification_number'],

            // Autenticación
            'email'                => ['required', 'email', 'max:100', 'unique:users,email'],
            'password'             => ['required', 'string', 'min:8', 'max:100', 'confirmed'],

            // Información institucional
            'username'             => ['nullable', 'string', 'max:50', 'unique:users,username'], // Se puede generar automáticamente si no se envía
            'employee_id'          => ['nullable', 'string', 'max:20', 'unique:users,employee_id'],
            'job_title'            => ['required', 'string', 'max:100'],
            'phone_number'         => ['nullable', 'string', 'max:20'],
            'personal_email'       => ['nullable', 'email', 'max:100'],
            'institutional_email'  => ['nullable', 'email', 'max:100'],

            'department_id'        => ['nullable', 'exists:departments,id'],
            'branch_id'            => ['nullable', 'exists:branches,id'],
            'location_id'          => ['nullable', 'exists:locations,id'],

            // Estado y consentimiento
            'status'               => ['nullable', 'in:activo,inactivo,suspendido,eliminado'],
            'account_valid_from'   => ['nullable', 'date'],
            'account_valid_until'  => ['nullable', 'date', 'after_or_equal:account_valid_from'],

            // Roles y control de acceso
            'role'                 => ['required', 'exists:roles,name'],

            // Permisos individuales
            'permissions'          => ['nullable', 'array'],
            'permissions.*'        => ['string', 'exists:permissions,name'],

            // Consentimientos RGPD / Ley 1581
            'consent_data_processing' => ['nullable', 'boolean'],
            'consent_marketing'       => ['nullable', 'boolean'],
            'consent_data_sharing'    => ['nullable', 'boolean'],
        ];
    }

    /**
     * Mensajes personalizados (accesibles y claros).
     */
    public function messages(): array
    {
        return [
            'document_type.required'         => 'El tipo de documento es obligatorio.',
            'document_type.in'               => 'Seleccione un tipo de documento válido.',
            'identification_number.required' => 'El número de identificación es obligatorio.',
            'identification_number.unique'   => 'Este número de identificación ya está registrado.',
            'email.required'                 => 'El correo electrónico es obligatorio.',
            'email.email'                    => 'Ingrese un correo válido.',
            'email.unique'                   => 'Este correo electrónico ya está registrado.',
            'username.unique'                => 'Este nombre de usuario ya está en uso.',
            'employee_id.unique'             => 'Este número de ficha o código ya está asignado.',
            'role.required'                  => 'Debe asignar un rol al usuario.',
            'role.exists'                    => 'El rol seleccionado no es válido.',
            'password.confirmed'             => 'La confirmación de contraseña no coincide.',
            'account_valid_until.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la de inicio.',
        ];
    }
}

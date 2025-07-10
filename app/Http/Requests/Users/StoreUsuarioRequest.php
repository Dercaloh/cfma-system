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
     * Reglas de validación para el registro de usuarios.
     */
    public function rules(): array
    {
        return [
            // Datos personales
            'first_name'           => 'required|string|max:50',
            'last_name'            => 'required|string|max:50',

            // Identificación
            'document_type'        => 'required|in:CC,CE,TI,PA,NIT', // CC: cédula, CE: extranjería, TI: tarjeta, PA: pasaporte, NIT: empresas
            'identification_number'=> 'required|string|max:20|unique:users,identification_number',

            // Correo y autenticación
            'email'                => 'required|email|max:100|unique:users,email',
            'password'             => 'required|string|min:8|max:100|confirmed',

            // Datos institucionales
            'job_title'            => 'required|string|max:100',
            'department_id'        => 'nullable|exists:departments,id',
            'branch_id'            => 'nullable|exists:branches,id',
            'location_id'          => 'nullable|exists:locations,id',

            // Rol obligatorio
            'role'                 => 'required|exists:roles,name',

            // Consentimientos opcionales
            'consent_data_processing' => 'nullable|boolean',
            'consent_marketing'       => 'nullable|boolean',
            'consent_data_sharing'    => 'nullable|boolean',
        ];
    }

    /**
     * Personaliza los mensajes de error (accesibilidad y claridad).
     */
    public function messages(): array
    {
        return [
            'document_type.required'         => 'El tipo de documento es obligatorio.',
            'document_type.in'               => 'Seleccione un tipo de documento válido.',
            'identification_number.required' => 'El número de identificación es obligatorio.',
            'identification_number.unique'   => 'Este número de identificación ya está registrado.',
            'email.unique'                   => 'Este correo ya está en uso.',
            'role.required'                  => 'Debe asignar un rol al usuario.',
            'role.exists'                    => 'El rol seleccionado no es válido.',
        ];
    }
}

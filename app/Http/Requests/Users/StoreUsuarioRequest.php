<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class StoreUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // La política ya controla el acceso en el controlador
    }


    public function rules(): array
    {
        return [
            'first_name'            => ['required', 'string', 'max:50'],
            'last_name'             => ['required', 'string', 'max:50'],
            'document_type'         => ['required', 'in:CC,TI,CE,NIT,PAS'],
            'identification_number' => ['required', 'string', 'max:20', 'unique:users,identification_number'],
            'institutional_email'   => ['required', 'email', 'max:100', 'unique:users,email'],
            'personal_email'        => ['nullable', 'email', 'max:100'],
            'password'              => [$this->isMethod('post') ? 'required' : 'nullable', 'string', 'min:8', 'max:100', 'confirmed'],
            'department_id'         => ['required', 'exists:departments,id'],
            'position_id'           => ['required', 'exists:positions,id'],
            'branch_id'             => ['nullable', 'exists:branches,id'],
            'location_id'           => ['nullable', 'exists:locations,id'],
            'role'                  => ['required', 'exists:roles,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required'           => 'Los nombres son obligatorios.',
            'first_name.max'                => 'Los nombres no pueden exceder 50 caracteres.',
            'last_name.required'            => 'Los apellidos son obligatorios.',
            'last_name.max'                 => 'Los apellidos no pueden exceder 50 caracteres.',
            'document_type.required'        => 'El tipo de documento es obligatorio.',
            'document_type.in'              => 'Seleccione un tipo de documento válido.',
            'identification_number.required' => 'El número de documento es obligatorio.',
            'identification_number.max'     => 'El número de documento no puede exceder 20 caracteres.',
            'identification_number.unique'  => 'Este número de documento ya está registrado.',
            'institutional_email.required'  => 'El correo institucional es obligatorio.',
            'institutional_email.email'     => 'Ingrese un correo institucional válido.',
            'institutional_email.max'       => 'El correo institucional no puede exceder 100 caracteres.',
            'institutional_email.unique'    => 'Este correo institucional ya está registrado.',
            'personal_email.email'          => 'Ingrese un correo personal válido.',
            'personal_email.max'            => 'El correo personal no puede exceder 100 caracteres.',
            'password.required'             => 'La contraseña es obligatoria para crear un usuario.',
            'password.min'                  => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max'                  => 'La contraseña no puede exceder 100 caracteres.',
            'password.confirmed'            => 'La confirmación de contraseña no coincide.',
            'department_id.required'        => 'Debe seleccionar una dependencia.',
            'department_id.exists'          => 'La dependencia seleccionada no es válida.',
            'position_id.required'          => 'Debe seleccionar un cargo.',
            'position_id.exists'            => 'El cargo seleccionado no es válido.',
            'branch_id.exists'              => 'La sede seleccionada no es válida.',
            'location_id.exists'            => 'La ubicación seleccionada no es válida.',
            'role.required'                 => 'Debe asignar un rol al usuario.',
            'role.exists'                  => 'El rol seleccionado no es válido.',
        ];
    }
}

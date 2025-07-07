<?php

namespace App\Http\Requests\Usuarios;


use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasRole('Administrador');
    }

    public function rules(): array
    {
        return [
            'first_name'     => 'required|string|max:50',
            'last_name'      => 'required|string|max:50',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:8|confirmed',
            'job_title'      => 'required|string|max:100',
            'department_id'  => 'nullable|exists:departments,id',
            'branch_id'      => 'nullable|exists:branches,id',
            'location_id'    => 'nullable|exists:locations,id',
            'role'           => 'required|exists:roles,name',
            'branch_id' => 'nullable|exists:branches,id',

        ];
    }
}

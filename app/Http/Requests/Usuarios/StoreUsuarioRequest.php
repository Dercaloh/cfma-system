<?php

namespace App\Http\Requests;

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
            'department_id'  => 'nullable|exists:departments,id',
            'location_id'    => 'nullable|exists:locations,id',
            'role'           => 'required|exists:roles,name',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
    return $this->user() && $this->user()->role->name === 'administrador';
    }


    public function rules(): array
    {
        return [
            'serial_number' => 'required|string|max:255|unique:assets,serial_number',

            // Placa solo es requerida si el activo es del centro
            'placa' => [
                'nullable',
                'string',
                Rule::requiredIf(fn () => $this->ownership === 'Centro'),
                'unique:assets,placa',
            ],

            'ownership'    => 'required|in:Centro,Personal',
            'type'         => 'required|in:Portátil,Proyector,Router,Switch,Impresora,Otro',
            'brand'        => 'nullable|string|max:255',
            'model'        => 'nullable|string|max:255',
            'status'       => 'required|in:Disponible,Prestado,En mantenimiento,Retirado',
            'condition'    => 'required|in:Bueno,Regular,Dañado,En diagnóstico',
            'location'     => 'required|in:Almacén,Con usuario',
            'loanable'     => 'boolean',
            'movable'      => 'boolean',
            'assigned_to'  => 'nullable|exists:users,id',
            'description'  => 'nullable|string|max:1000',
        ];
    }
}


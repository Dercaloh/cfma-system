<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'serial_number' => 'required|string|max:100|unique:assets,serial_number',
            'type_id' => 'required|exists:asset_types,id',
            'name' => 'required|string|max:100',
            'brand' => 'nullable|string|max:50',
            'model' => 'nullable|string|max:50',
            'year_purchased' => 'nullable|digits:4|integer|min:1990|max:' . date('Y'),
            'status' => 'in:Disponible,Prestado,En mantenimiento,Retirado',
            'condition' => 'in:Bueno,Regular,Dañado,En diagnóstico',
            'location_id' => 'nullable|exists:locations,id',
            'assigned_to' => 'nullable|exists:users,id',
            'loanable' => 'boolean',
            'movable' => 'boolean',
            'description' => 'nullable|string',
        ];
    }
}

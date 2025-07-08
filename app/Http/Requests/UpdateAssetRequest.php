<?php
/*-- App/Http/Requests/UpdateAssetRequest.php */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAssetRequest extends FormRequest
{
     public function authorize(): bool
    {
    return $this->user() && $this->user()->role->name === 'administrador';
    }

    public function rules(): array
    {
        $assetId = $this->route('asset')->id ?? null;

        return [
            'serial_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('assets', 'serial_number')->ignore($assetId),
                Rule::unique('assets', 'serial_number')->whereNull('deleted_at')
            ],

            'placa' => [
                'nullable',
                'string',
                Rule::requiredIf(fn () => $this->ownership === 'Centro'),
                Rule::unique('assets', 'placa')->ignore($assetId),
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


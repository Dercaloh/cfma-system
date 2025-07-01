<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasRole('administrador');
    }

    public function rules(): array
    {
        $assetId = $this->route('asset')->id ?? null;

        return [
            // Datos del activo principal
            'name'          => ['required', 'string', 'max:100'],
            'serial_number' => [
                'required', 'string', 'max:100',
                Rule::unique('assets', 'serial_number')
                    ->ignore($assetId)
                    ->whereNull('deleted_at'),
            ],
            'placa' => [
                'nullable', 'string', 'max:50',
                Rule::requiredIf(fn () => $this->input('ownership') === 'Centro'),
                Rule::unique('assets', 'placa')
                    ->ignore($assetId)
                    ->whereNull('deleted_at'),
            ],
            'ownership' => ['required', Rule::in(['Centro', 'Personal'])],
            'type_id'   => ['required', 'exists:asset_types,id'],
            'brand'     => ['nullable', 'string', 'max:50'],
            'model'     => ['nullable', 'string', 'max:50'],
            'year_purchased' => ['nullable', 'integer', 'digits:4', 'min:2000', 'max:' . now()->year],

            'status'    => ['required', Rule::in(['Disponible', 'Prestado', 'En mantenimiento', 'Retirado'])],
            'condition' => ['required', Rule::in(['Bueno', 'Regular', 'Dañado', 'En diagnóstico'])],
            'location_id' => ['nullable', 'exists:locations,id'],
            'loanable'  => ['boolean'],
            'movable'   => ['boolean'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'description' => ['nullable', 'string', 'max:1000'],

            // Datos de hardware opcionales
            'hardware.mac_address' => [
                'nullable',
                'string',
                'regex:/^([0-9A-Fa-f]{2}:){5}[0-9A-Fa-f]{2}$/',
                Rule::unique('asset_hardware_details', 'mac_address')->ignore($assetId, 'asset_id')
            ],
            'hardware.os'           => ['nullable', 'string', 'max:50'],
            'hardware.bios_version' => ['nullable', 'string', 'max:50'],
            'hardware.cpu'          => ['nullable', 'string', 'max:100'],
            'hardware.ram'          => ['nullable', 'string', 'max:50'],
            'hardware.storage'      => ['nullable', 'string', 'max:100'],

            // Datos de software (array múltiple)
            'software' => ['nullable', 'array'],
            'software.*.name' => ['required_with:software', 'string', 'max:150'],
            'software.*.version' => ['nullable', 'string', 'max:50'],
            'software.*.vendor' => ['nullable', 'string', 'max:100'],
            'software.*.license_status' => ['nullable', Rule::in(['autorizado', 'no_autorizado', 'desactualizado'])],
            'software.*.install_date' => ['nullable', 'date', 'before_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'placa.required_if' => 'La placa es obligatoria si el activo pertenece al Centro.',
            'hardware.mac_address.regex' => 'La MAC debe tener el formato correcto (ej: 00:1A:2B:3C:4D:5E).',
        ];
    }
}

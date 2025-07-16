<?php

namespace App\Http\Requests\Assets;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class UpdateAssetTypeRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('gestionar activos');
    }


    /**
     * Reglas de validación que se aplican al request.
     */
    public function rules(): array
    {
        $assetTypeId = $this->route('assetType')?->id ?? $this->route('asset_type');

        return [
            'name' => [
                'required',
                'string',
                'max:50',
                'min:2',
                Rule::unique('asset_types', 'name')
                    ->whereNull('deleted_at')
                    ->ignore($assetTypeId),
                'regex:/^(?!\s*$).+/', // No solo espacios
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^(?!\s*$).+/', // No solo espacios
            ],
            'active' => [
                'boolean',
            ],
        ];
    }

    /**
     * Mensajes personalizados para errores de validación.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del tipo de activo es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'name.max' => 'El nombre no puede tener más de 50 caracteres.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'name.unique' => 'Ya existe un tipo de activo con ese nombre.',
            'name.regex' => 'El nombre no puede estar compuesto solo por espacios en blanco.',

            'description.string' => 'La descripción debe ser texto.',
            'description.max' => 'La descripción no puede superar los 255 caracteres.',
            'description.regex' => 'La descripción no puede estar compuesta solo por espacios en blanco.',

            'active.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }

    /**
     * Atributos personalizados para los errores de validación.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'description' => 'descripción',
            'active' => 'activo',
        ];
    }

    /**
     * Preparar datos antes de la validación.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->name ? trim($this->name) : null,
            'description' => $this->description ? trim($this->description) : null,
            'active' => $this->has('active') ? $this->boolean('active') : true,
        ]);
    }

    /**
     * Validaciones adicionales personalizadas con after().
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Validar caracteres especiales en name
            if ($this->name && preg_match('/[<>"\']/', $this->name)) {
                $validator->errors()->add('name', 'El nombre no puede contener caracteres especiales como <, >, ", \'');
            }

            // Verificar que la descripción no tenga HTML
            if ($this->description && $this->description !== strip_tags($this->description)) {
                $validator->errors()->add('description', 'La descripción no puede contener código HTML.');
            }

            // Validar palabras reservadas
            $reservadas = ['admin', 'system', 'root', 'default', 'null', 'undefined'];
            if ($this->name && in_array(strtolower($this->name), $reservadas)) {
                $validator->errors()->add('name', 'El nombre no puede ser una palabra reservada del sistema.');
            }

            // No permitir desactivar si tiene activos asociados
            if ($this->filled('active') && !$this->boolean('active')) {
                $assetType = $this->route('assetType') ?? $this->route('asset_type');
                if ($assetType && method_exists($assetType, 'assets') && $assetType->assets()->count() > 0) {
                    $validator->errors()->add('active', 'No se puede desactivar un tipo de activo que tiene activos asociados.');
                }
            }
        });
    }

    /**
     * Manejo de errores personalizados al fallar la validación.
     */
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        Log::warning('Falló la validación al actualizar tipo de activo', [
            'user_id' => $this->user()?->id,
            'asset_type_id' => $this->route('assetType')?->id ?? $this->route('asset_type'),
            'errors' => $validator->errors()->toArray(),
            'input' => $this->except(['_token', '_method']),
        ]);

        parent::failedValidation($validator);
    }
}

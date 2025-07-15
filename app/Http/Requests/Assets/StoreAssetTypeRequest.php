<?php

namespace App\Http\Requests\Assets;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class StoreAssetTypeRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        // Permitir solo a usuarios con permiso específico
        return $this->user()?->can('gestionar tipos de activos');
    }

    /**
     * Reglas de validación aplicables.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:50',
                Rule::unique('asset_types', 'name')->whereNull('deleted_at'),
                'regex:/^(?!\s*$).+/', // No solo espacios
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^(?!\s*$).+/', // Si se proporciona, no solo espacios
            ],
            'active' => [
                'boolean',
            ],
        ];
    }

    /**
     * Mensajes personalizados de error.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del tipo de activo es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto válida.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'name.max' => 'El nombre no puede exceder los 50 caracteres.',
            'name.unique' => 'Ya existe un tipo de activo con este nombre.',
            'name.regex' => 'El nombre no puede contener solo espacios en blanco.',

            'description.string' => 'La descripción debe ser una cadena de texto válida.',
            'description.max' => 'La descripción no puede exceder los 255 caracteres.',
            'description.regex' => 'La descripción no puede contener solo espacios en blanco.',

            'active.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }

    /**
     * Traducción de atributos para errores.
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
     * Prepara los datos antes de la validación.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->name !== null ? trim($this->name) : null,
            'description' => $this->description !== null ? trim($this->description) : null,
            'active' => $this->has('active') ? $this->boolean('active') : true,
        ]);
    }

    /**
     * Validaciones adicionales personalizadas.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $name = $this->input('name');
            $description = $this->input('description');

            if (!blank($name) && preg_match('/[<>"\']/', $name)) {
                $validator->errors()->add('name', 'El nombre no puede contener caracteres especiales como <, >, ", \'.');
            }

            if (!blank($description) && $description !== strip_tags($description)) {
                $validator->errors()->add('description', 'La descripción no puede contener código HTML.');
            }

            $palabrasReservadas = ['admin', 'system', 'root', 'default', 'null', 'undefined'];
            if (!blank($name) && in_array(strtolower($name), $palabrasReservadas)) {
                $validator->errors()->add('name', 'El nombre no puede ser una palabra reservada del sistema.');
            }
        });
    }

    /**
     * Acción en caso de fallo en la validación.
     */
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        Log::warning('Falló la validación al crear tipo de activo', [
            'user_id' => $this->user()?->id,
            'errors' => $validator->errors()->toArray(),
            'input' => $this->except(['_token']),
        ]);

        parent::failedValidation($validator);
    }
}

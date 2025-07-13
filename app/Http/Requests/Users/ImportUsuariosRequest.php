<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\User;
use Spatie\Permission\Models\Role;

class ImportUsuariosRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user instanceof User && $user->can('importar usuarios');
    }

    public function rules(): array
    {
        return [
            // Archivos de entrada
            'archivo' => [
                'required_without:temp_file',
                'file', 'mimes:xlsx,xls,csv', 'max:10240',
                function ($attribute, $value, $fail) {
                    if ($value && $value->getSize() === 0) {
                        $fail('El archivo no puede estar vacío.');
                    }
                }
            ],
            'temp_file' => [
                'required_without:archivo',
                'string', 'max:255',
                function ($attribute, $value, $fail) {
                    if ($value && !preg_match('/^import_preview_\d+_\d+\.(xlsx|xls|csv)$/', $value)) {
                        $fail('Formato de archivo temporal inválido.');
                    }
                }
            ],

            // Opciones de importación
            'actualizar_existentes' => 'boolean',
            'enviar_notificaciones' => 'boolean',
            'cambiar_password' => 'boolean',
            'skip_duplicates' => 'boolean',
            'validate_only' => 'boolean',
            'send_summary_email' => 'boolean',

            // Contraseña por defecto
            'password_default' => [
                'nullable', 'string', 'min:8', 'max:255',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/',
                fn ($attribute, $value, $fail) =>
                    $value && $this->isWeakPassword($value)
                        ? $fail('La contraseña por defecto debe ser más segura.')
                        : null
            ],

            // Rol por defecto
            'rol_default' => [
                'nullable', 'string', 'exists:roles,name',
                fn ($attribute, $value, $fail) => $this->validateRolPermiso($value, $fail)
            ],

            // Otras configuraciones
            'max_records' => 'nullable|integer|min:1|max:1000',
            'notification_template' => 'nullable|string|exists:notification_templates,slug',
            'notification_delay' => 'nullable|integer|min:0|max:1440',
            'audit_level' => 'nullable|string|in:basic,detailed,full',
            'include_metadata' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'archivo.required_without' => 'Debe subir un archivo para importar.',
            'archivo.mimes' => 'El archivo debe ser .xlsx, .xls o .csv.',
            'archivo.max' => 'El archivo no debe superar los 10MB.',
            'temp_file.required_without' => 'Se requiere un archivo temporal o uno nuevo.',

            'password_default.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password_default.regex' => 'Debe contener mayúscula, minúscula, número y símbolo especial.',

            'rol_default.exists' => 'El rol especificado no existe.',
            'max_records.max' => 'Máximo permitido: 1000 registros.',
            'notification_template.exists' => 'La plantilla de notificación no es válida.',
            'notification_delay.max' => 'El retraso máximo permitido es de 1440 minutos (24 horas).',
            'audit_level.in' => 'Nivel de auditoría inválido. Use: basic, detailed o full.'
        ];
    }

    public function attributes(): array
    {
        return [
            'archivo' => 'archivo de importación',
            'temp_file' => 'archivo temporal',
            'actualizar_existentes' => 'actualizar usuarios existentes',
            'enviar_notificaciones' => 'enviar notificaciones',
            'cambiar_password' => 'requerir cambio de contraseña',
            'password_default' => 'contraseña por defecto',
            'rol_default' => 'rol por defecto',
            'max_records' => 'límite máximo de registros',
            'skip_duplicates' => 'omitir duplicados',
            'validate_only' => 'solo validar',
            'send_summary_email' => 'resumen por correo',
            'notification_template' => 'plantilla de notificación',
            'notification_delay' => 'retraso de notificación',
            'audit_level' => 'nivel de auditoría',
            'include_metadata' => 'incluir metadatos',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'actualizar_existentes' => $this->boolean('actualizar_existentes'),
            'enviar_notificaciones' => $this->boolean('enviar_notificaciones'),
            'cambiar_password' => $this->boolean('cambiar_password', true),
            'skip_duplicates' => $this->boolean('skip_duplicates', true),
            'validate_only' => $this->boolean('validate_only'),
            'send_summary_email' => $this->boolean('send_summary_email'),
            'include_metadata' => $this->boolean('include_metadata'),
            'audit_level' => $this->input('audit_level', 'basic'),
            'max_records' => $this->input('max_records', 500),
            'notification_delay' => $this->input('notification_delay', 0),
        ]);

        if ($this->has('password_default')) {
            $this->request->add(['_has_sensitive_data' => true]);
        }
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $this->validateImportCombinations($validator);
            $this->validateResourceLimits($validator);
            $this->validateSpecificPermissions($validator);
        });
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        Log::warning('Validación fallida al importar usuarios', [
            'user_id' => Auth::id(),
            'ip_address' => $this->ip(),
            'user_agent' => $this->userAgent(),
            'errors' => $validator->errors()->toArray(),
            'has_file' => $this->hasFile('archivo'),
            'temp_file' => $this->input('temp_file'),
            'timestamp' => now()->toISOString(),
        ]);

        throw new ValidationException($validator);
    }

    private function validateImportCombinations($validator): void
    {
        if ($this->boolean('validate_only') && $this->boolean('enviar_notificaciones')) {
            $validator->errors()->add('enviar_notificaciones', 'No se pueden enviar notificaciones en modo validación.');
        }

        if (!$this->boolean('actualizar_existentes') && $this->boolean('cambiar_password')) {
            $validator->errors()->add('cambiar_password', 'No se puede requerir cambio de contraseña sin actualización.');
        }

        if ($this->boolean('enviar_notificaciones') && !$this->filled('notification_template')) {
            $validator->errors()->add('notification_template', 'Debe especificar una plantilla de notificación.');
        }
    }

    private function validateResourceLimits($validator): void
    {
        $user = Auth::user();
        $limite = $user->import_limit ?? 100;

        if ((int)$this->input('max_records', 500) > $limite) {
            $validator->errors()->add('max_records', "Límite de registros superado: máximo {$limite} permitidos.");
        }

        if (method_exists($user, 'activities')) {
            $recent = $user->activities()->where('log_name', 'user_import')
                ->where('created_at', '>=', now()->subHour())->count();

            if ($recent >= 3) {
                $validator->errors()->add('general', 'Límite de intentos de importación por hora alcanzado.');
            }
        }
    }

    private function validateSpecificPermissions($validator): void
    {
        $user = Auth::user();

        if ($this->boolean('actualizar_existentes') && !$user->can('gestionar usuarios')) {
            $validator->errors()->add('actualizar_existentes', 'No tiene permiso para actualizar usuarios.');
        }

        if ($this->boolean('enviar_notificaciones') && !$user->can('enviar notificaciones masivas')) {
            $validator->errors()->add('enviar_notificaciones', 'No tiene permiso para enviar notificaciones masivas.');
        }

        if ($this->filled('rol_default') && !$user->can('asignar roles')) {
            $validator->errors()->add('rol_default', 'No tiene permiso para asignar roles.');
        }
    }

    private function validateRolPermiso($rol, $fail): void
    {
        if (!$rol) return;

        $user = Auth::user();
        $role = Role::where('name', $rol)->first();

        if ($role && !$user->can("assign role {$role->name}") && !$user->can('asignar roles')) {
            $fail('No tiene permiso para asignar este rol.');
        }
    }

    private function isWeakPassword(string $password): bool
    {
        return in_array(strtolower($password), [
            'password', '123456', 'admin', 'sena2024', 'cfma2024',
            'usuario', 'temporal', 'cambiar', 'Password1!', 'Admin123!',
        ]);
    }

    public function validatedWithClassification(): array
    {
        $data = $this->validated();
        $data['_security_classification'] = [
            'archivo' => 'classified',
            'temp_file' => 'classified',
            'password_default' => 'reserved',
            'rol_default' => 'classified',
            'audit_level' => 'classified',
            'notification_template' => 'public',
        ];
        return $data;
    }

    public function getAuditSummary(): array
    {
        return [
            'action' => 'importar_usuarios',
            'user_id' => Auth::id(),
            'ip_address' => $this->ip(),
            'user_agent' => $this->userAgent(),
            'has_file' => $this->hasFile('archivo'),
            'file_size' => $this->hasFile('archivo') ? $this->file('archivo')->getSize() : null,
            'timestamp' => now()->toISOString(),
            'options' => $this->only([
                'actualizar_existentes', 'enviar_notificaciones', 'cambiar_password',
                'skip_duplicates', 'validate_only', 'audit_level', 'max_records',
            ]),
            'classification' => 'classified'
        ];
    }
}

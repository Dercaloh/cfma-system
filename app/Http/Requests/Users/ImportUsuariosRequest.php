<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\User;
use Spatie\Permission\Models\Role;

/**
 * Form Request para validar importación masiva de usuarios
 *
 * Cumple con:
 * - Ley 1581 (Protección de datos personales)
 * - ISO 27001 (Seguridad de la información)
 * - Resolución 1122/2023 (Accesibilidad)
 * - WCAG 2.1 Nivel AA
 *
 * @package App\Http\Requests\Users
 */
class ImportUsuariosRequest extends FormRequest
{
    /**
     * Determinar si el usuario está autorizado para realizar esta solicitud
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Verificar que el usuario tenga permisos para importar usuarios
        $user = Auth::user();
        return $user && $user instanceof User && $user->can('import users');
    }

    /**
     * Reglas de validación para la importación
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            // Validación del archivo (🟡 Información Clasificada)
            'archivo' => [
                'required_without:temp_file',
                'file',
                'mimes:xlsx,xls,csv',
                'max:10240', // 10MB máximo
                function ($attribute, $value, $fail) {
                    if ($value && $value->getSize() === 0) {
                        $fail('El archivo no puede estar vacío.');
                    }
                }
            ],

            // Archivo temporal de preview (🟡 Información Clasificada)
            'temp_file' => [
                'required_without:archivo',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if ($value && !preg_match('/^import_preview_\d+_\d+\.(xlsx|xls|csv)$/', $value)) {
                        $fail('Formato de archivo temporal inválido.');
                    }
                }
            ],

            // Opciones de importación (🟡 Información Clasificada)
            'actualizar_existentes' => 'boolean',
            'enviar_notificaciones' => 'boolean',
            'cambiar_password' => 'boolean',

            // Contraseña por defecto (🔴 Información Reservada)
            'password_default' => [
                'nullable',
                'string',
                'min:8',
                'max:255',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
                function ($attribute, $value, $fail) {
                    if ($value && $this->isWeakPassword($value)) {
                        $fail('La contraseña por defecto debe ser más segura.');
                    }
                }
            ],

            // Rol por defecto (🟡 Información Clasificada)
            'rol_default' => [
                'nullable',
                'string',
                'exists:roles,name',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $user = Auth::user();
                        if (!$user instanceof User) {
                            $fail('Usuario no autenticado correctamente.');
                            return;
                        }

                        // Verificar si el usuario puede asignar este rol específico
                        $role = Role::where('name', $value)->first();
                        if ($role && !$user->can('assign role') && !$user->can("assign role {$role->name}")) {
                            $fail('No tiene permisos para asignar este rol.');
                        }
                    }
                }
            ],

            // Validación de límites operacionales
            'max_records' => 'nullable|integer|min:1|max:1000',

            // Opciones de procesamiento
            'skip_duplicates' => 'boolean',
            'validate_only' => 'boolean',
            'send_summary_email' => 'boolean',

            // Configuración de notificaciones
            'notification_template' => 'nullable|string|exists:notification_templates,slug',
            'notification_delay' => 'nullable|integer|min:0|max:1440', // En minutos

            // Opciones de auditoría (🟡 Información Clasificada)
            'audit_level' => 'nullable|string|in:basic,detailed,full',
            'include_metadata' => 'boolean'
        ];

        // Validaciones adicionales para modo preview
        if ($this->isMethod('post') && $this->route()->getName() === 'users.import.preview') {
            $rules['archivo']['required'] = true;
            unset($rules['temp_file']);
        }

        return $rules;
    }

    /**
     * Mensajes de error personalizados y accesibles
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Mensajes de archivo
            'archivo.required_without' => 'Debe seleccionar un archivo para importar.',
            'archivo.file' => 'El archivo seleccionado no es válido.',
            'archivo.mimes' => 'El archivo debe ser de tipo Excel (.xlsx, .xls) o CSV (.csv).',
            'archivo.max' => 'El archivo no puede exceder los 10 MB.',

            // Mensajes de archivo temporal
            'temp_file.required_without' => 'Se requiere un archivo temporal para continuar.',
            'temp_file.string' => 'El identificador del archivo temporal no es válido.',

            // Mensajes de contraseña
            'password_default.min' => 'La contraseña por defecto debe tener al menos 8 caracteres.',
            'password_default.regex' => 'La contraseña debe contener al menos: 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial.',

            // Mensajes de rol
            'rol_default.exists' => 'El rol seleccionado no existe en el sistema.',

            // Mensajes de límites
            'max_records.max' => 'No se pueden procesar más de 1000 registros por importación.',
            'max_records.min' => 'Debe especificar al menos 1 registro para procesar.',

            // Mensajes de notificaciones
            'notification_template.exists' => 'La plantilla de notificación seleccionada no existe.',
            'notification_delay.max' => 'El retraso de notificación no puede exceder 24 horas (1440 minutos).',

            // Mensajes de auditoría
            'audit_level.in' => 'El nivel de auditoría debe ser: básico, detallado o completo.',
        ];
    }

    /**
     * Atributos personalizados para mensajes de error
     *
     * @return array<string, string>
     */
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
            'max_records' => 'máximo de registros',
            'skip_duplicates' => 'omitir duplicados',
            'validate_only' => 'solo validar',
            'send_summary_email' => 'enviar resumen por correo',
            'notification_template' => 'plantilla de notificación',
            'notification_delay' => 'retraso de notificación',
            'audit_level' => 'nivel de auditoría',
            'include_metadata' => 'incluir metadatos'
        ];
    }

    /**
     * Preparar los datos para validación
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        // Establecer valores por defecto
        $this->merge([
            'actualizar_existentes' => $this->boolean('actualizar_existentes', false),
            'enviar_notificaciones' => $this->boolean('enviar_notificaciones', false),
            'cambiar_password' => $this->boolean('cambiar_password', true),
            'skip_duplicates' => $this->boolean('skip_duplicates', true),
            'validate_only' => $this->boolean('validate_only', false),
            'send_summary_email' => $this->boolean('send_summary_email', false),
            'include_metadata' => $this->boolean('include_metadata', false),
            'audit_level' => $this->input('audit_level', 'basic'),
            'max_records' => $this->input('max_records', 500),
            'notification_delay' => $this->input('notification_delay', 0),
        ]);

        // Limpiar datos sensibles de logs automáticos
        if ($this->has('password_default')) {
            $this->request->add(['_has_sensitive_data' => true]);
        }
    }

    /**
     * Configurar validador personalizado
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Validación personalizada de combinaciones
            $this->validateImportCombinations($validator);

            // Validación de límites de recursos
            $this->validateResourceLimits($validator);

            // Validación de permisos específicos
            $this->validateSpecificPermissions($validator);
        });
    }

    /**
     * Manejar errores de validación fallidos
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        // Registrar intento de importación fallido (🟡 Información Clasificada)
        Log::warning('Validación fallida en importación de usuarios', [
            'user_id' => Auth::id(),
            'ip_address' => $this->ip(),
            'user_agent' => $this->userAgent(),
            'errors' => $validator->errors()->toArray(),
            'has_file' => $this->hasFile('archivo'),
            'temp_file' => $this->input('temp_file'),
            'timestamp' => now()->toISOString(),
            'classification' => 'classified' // 🟡
        ]);

        // Crear excepción de validación con mensajes accesibles
        $exception = new ValidationException($validator);

        // Agregar información de accesibilidad
        $exception->redirectTo = $this->getRedirectUrl();
        $exception->errorBag = $this->errorBag;

        throw $exception;
    }

    /**
     * Validar combinaciones de opciones de importación
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    private function validateImportCombinations($validator): void
    {
        // Si solo se valida, no se pueden enviar notificaciones
        if ($this->boolean('validate_only') && $this->boolean('enviar_notificaciones')) {
            $validator->errors()->add('enviar_notificaciones',
                'No se pueden enviar notificaciones en modo solo validación.');
        }

        // Si no se actualizan existentes, no se puede requerir cambio de contraseña
        if (!$this->boolean('actualizar_existentes') && $this->boolean('cambiar_password')) {
            $validator->errors()->add('cambiar_password',
                'No se puede requerir cambio de contraseña sin actualizar usuarios existentes.');
        }

        // Validar que si se envían notificaciones, hay template
        if ($this->boolean('enviar_notificaciones') && !$this->has('notification_template')) {
            $validator->errors()->add('notification_template',
                'Debe seleccionar una plantilla de notificación.');
        }
    }

    /**
     * Validar límites de recursos del sistema
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    private function validateResourceLimits($validator): void
    {
        // Validar límites de usuario actual
        $user = Auth::user();
        if (!$user instanceof User) {
            $validator->errors()->add('general', 'Usuario no autenticado correctamente.');
            return;
        }

        $userImportLimit = $user->import_limit ?? 100;

        if ($this->input('max_records', 500) > $userImportLimit) {
            $validator->errors()->add('max_records',
                "Su límite de importación es de {$userImportLimit} registros.");
        }

        // Validar límites de tiempo (importaciones recientes)
        // Verificar si el usuario tiene el trait LogsActivity
        if (method_exists($user, 'activities')) {
            $recentImports = $user->activities()
                ->where('log_name', 'user_import')
                ->where('created_at', '>=', now()->subHour())
                ->count();

            if ($recentImports >= 3) {
                $validator->errors()->add('general',
                    'Ha alcanzado el límite de importaciones por hora. Intente más tarde.');
            }
        }
    }

    /**
     * Validar permisos específicos del usuario
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    private function validateSpecificPermissions($validator): void
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            $validator->errors()->add('general', 'Usuario no autenticado correctamente.');
            return;
        }

        // Validar permiso para actualizar usuarios existentes
        if ($this->boolean('actualizar_existentes') && !$user->can('update users')) {
            $validator->errors()->add('actualizar_existentes',
                'No tiene permisos para actualizar usuarios existentes.');
        }

        // Validar permiso para enviar notificaciones masivas
        if ($this->boolean('enviar_notificaciones') && !$user->can('send mass notifications')) {
            $validator->errors()->add('enviar_notificaciones',
                'No tiene permisos para enviar notificaciones masivas.');
        }

        // Validar permiso para asignar roles
        if ($this->has('rol_default') && !$user->can('assign roles')) {
            $validator->errors()->add('rol_default',
                'No tiene permisos para asignar roles a usuarios.');
        }
    }

    /**
     * Verificar si una contraseña es débil
     *
     * @param string $password
     * @return bool
     */
    private function isWeakPassword(string $password): bool
    {
        $weakPasswords = [
            'password', '123456', 'admin', 'sena2024', 'cfma2024',
            'usuario', 'temporal', 'cambiar', 'Password1!', 'Admin123!'
        ];

        return in_array(strtolower($password), array_map('strtolower', $weakPasswords));
    }

    /**
     * Obtener datos validados con clasificación de seguridad
     *
     * @return array
     */
    public function validatedWithClassification(): array
    {
        $validated = $this->validated();

        // Agregar metadatos de clasificación
        $validated['_security_classification'] = [
            'archivo' => 'classified',           // 🟡
            'temp_file' => 'classified',         // 🟡
            'password_default' => 'reserved',    // 🔴
            'rol_default' => 'classified',       // 🟡
            'audit_level' => 'classified',       // 🟡
            'notification_template' => 'public', // 🟢
            'actualizar_existentes' => 'public', // 🟢
            'enviar_notificaciones' => 'public', // 🟢
            'cambiar_password' => 'public',      // 🟢
        ];

        return $validated;
    }

    /**
     * Obtener resumen de la solicitud para auditoría
     *
     * @return array
     */
    public function getAuditSummary(): array
    {
        return [
            'action' => 'import_usuarios_request',
            'user_id' => Auth::id(),
            'ip_address' => $this->ip(),
            'user_agent' => $this->userAgent(),
            'has_file' => $this->hasFile('archivo'),
            'file_size' => $this->hasFile('archivo') ? $this->file('archivo')->getSize() : null,
            'options' => [
                'actualizar_existentes' => $this->boolean('actualizar_existentes'),
                'enviar_notificaciones' => $this->boolean('enviar_notificaciones'),
                'cambiar_password' => $this->boolean('cambiar_password'),
                'skip_duplicates' => $this->boolean('skip_duplicates'),
                'validate_only' => $this->boolean('validate_only'),
                'audit_level' => $this->input('audit_level', 'basic'),
                'max_records' => $this->input('max_records', 500),
            ],
            'timestamp' => now()->toISOString(),
            'classification' => 'classified' // 🟡
        ];
    }
}

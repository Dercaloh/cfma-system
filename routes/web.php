<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Exports\TemplateExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/admin/usuarios/exportar-template', function () {
    $templateData = [
        'Usuarios' => [
            [
                'document_type' => 'CC',
                'identification_number' => '123456789',
                'first_name' => 'Ejemplo',
                'last_name' => 'Usuario',
                'username' => 'usuarioejemplo',
                'email' => 'usuario@sena.edu.co',
                'password' => 'Temporal123!',
                'employee_id' => 'EMP001',
                'position_id' => 1,
                'phone_number' => '3111234567',
                'personal_email' => 'ejemplo@gmail.com',
                'institutional_email' => 'usuario@sena.edu.co',
                'department_id' => 1,
                'branch_id' => 1,
                'location_id' => 1,
                'status' => 'activo',
                'account_valid_from' => '2024-01-01',
                'account_valid_until' => '2024-12-31',
            ]
        ],
        'Departamentos' => [
            [1, 'Planeación', 'Departamento de Planeación'],
            [2, 'Sistemas', 'Departamento de Sistemas'],
        ],
        'Cargos' => [
            [1, 'Analista TIC', 'Responsable soporte y sistemas'],
            [2, 'Coordinador TIC', 'Responsable estratégico'],
        ],
        'Sedes' => [
            [1, 'Principal', 'S001'],
            [2, 'Extensión', 'S002'],
        ],
        'Ubicaciones' => [
            [1, 'Bloque 1 - Oficina TIC', 'UB001'],
            [2, 'Bloque 3 - Coordinación', 'UB003'],
        ],
        'Instrucciones' => [
            ['document_type', 'Tipo de documento (CC, TI, etc.)', 'CC,TI,CE,NIT,PAS', 'Sí', 'CC'],
            ['email', 'Correo institucional único', 'Formato institucional', 'Sí', 'usuario@sena.edu.co'],
            ['password', 'Contraseña inicial', 'Mínimo 8 caracteres', 'Sí', 'Temporal123!'],
        ],
    ];

    TemplateExport::validateTemplateData($templateData); // Validación previa

    return Excel::download(new TemplateExport($templateData), 'plantilla_importacion_usuarios.xlsx');
})->middleware(['auth', 'role:admin']); // Asegura acceso restringido


require __DIR__.'/public.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/profile.php';
require __DIR__.'/prestamos.php';
require __DIR__.'/porteria.php';
require __DIR__.'/admin.php';
require __DIR__.'/system.php';
require __DIR__.'/auth.php'; // Breeze

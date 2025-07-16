<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DemoController extends Controller
{
    /**
     * Mostrar la vista de demo de componentes
     */
    public function components()
    {
        return view('demo.components');
    }

    /**
     * Simular filtrado de usuarios (para demo de table-filters)
     */
    public function users(Request $request): JsonResponse
    {
        // Datos de ejemplo
        $users = collect([
            [
                'id' => 1,
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@sena.edu.co',
                'role' => 'instructor',
                'status' => 'active',
                'created_at' => '2024-01-15'
            ],
            [
                'id' => 2,
                'name' => 'María García',
                'email' => 'maria.garcia@sena.edu.co',
                'role' => 'admin',
                'status' => 'active',
                'created_at' => '2024-01-10'
            ],
            [
                'id' => 3,
                'name' => 'Carlos Rodríguez',
                'email' => 'carlos.rodriguez@sena.edu.co',
                'role' => 'coordinator',
                'status' => 'pending',
                'created_at' => '2024-01-12'
            ],
            [
                'id' => 4,
                'name' => 'Ana López',
                'email' => 'ana.lopez@sena.edu.co',
                'role' => 'student',
                'status' => 'active',
                'created_at' => '2024-01-08'
            ],
            [
                'id' => 5,
                'name' => 'Pedro Martínez',
                'email' => 'pedro.martinez@sena.edu.co',
                'role' => 'instructor',
                'status' => 'inactive',
                'created_at' => '2024-01-05'
            ],
            [
                'id' => 6,
                'name' => 'Laura Sánchez',
                'email' => 'laura.sanchez@sena.edu.co',
                'role' => 'student',
                'status' => 'active',
                'created_at' => '2024-01-20'
            ]
        ]);

        // Aplicar filtros
        $filteredUsers = $users;

        // Filtro de búsqueda
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $filteredUsers = $filteredUsers->filter(function ($user) use ($search) {
                return strpos(strtolower($user['name']), $search) !== false ||
                       strpos(strtolower($user['email']), $search) !== false;
            });
        }

        // Filtro de estado
        if ($request->has('status') && $request->status !== 'all') {
            $filteredUsers = $filteredUsers->filter(function ($user) use ($request) {
                return $user['status'] === $request->status;
            });
        }

        // Filtro de rol
        if ($request->has('role') && $request->role !== 'all') {
            $filteredUsers = $filteredUsers->filter(function ($user) use ($request) {
                return $user['role'] === $request->role;
            });
        }

        // Filtro de fecha desde
        if ($request->has('created_from') && !empty($request->created_from)) {
            $filteredUsers = $filteredUsers->filter(function ($user) use ($request) {
                return $user['created_at'] >= $request->created_from;
            });
        }

        // Filtro de fecha hasta
        if ($request->has('created_to') && !empty($request->created_to)) {
            $filteredUsers = $filteredUsers->filter(function ($user) use ($request) {
                return $user['created_at'] <= $request->created_to;
            });
        }

        return response()->json([
            'success' => true,
            'data' => $filteredUsers->values()->all(),
            'total' => $filteredUsers->count(),
            'filters_applied' => $request->all()
        ]);
    }

    /**
     * Manejar subida de archivos de photo-capture (para demo)
     */
    public function uploadPhoto(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'photo_id' => 'required|string'
            ]);

            // Simular procesamiento de la imagen
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // En un entorno real, aquí guardarías el archivo
            // $path = $file->storeAs('uploads/photos', $filename, 'public');

            return response()->json([
                'success' => true,
                'message' => 'Imagen subida exitosamente',
                'data' => [
                    'filename' => $filename,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'url' => '/storage/uploads/photos/' . $filename // URL simulada
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al subir la imagen: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estadísticas para la demo
     */
    public function stats(): JsonResponse
    {
        return response()->json([
            'components_count' => 3,
            'demo_views' => rand(50, 200),
            'last_updated' => now()->format('Y-m-d H:i:s'),
            'components' => [
                'tab-navigation' => [
                    'status' => 'active',
                    'version' => '1.0.0',
                    'last_test' => now()->subDays(2)->format('Y-m-d')
                ],
                'photo-capture' => [
                    'status' => 'active',
                    'version' => '1.0.0',
                    'last_test' => now()->subDays(1)->format('Y-m-d')
                ],
                'table-filters' => [
                    'status' => 'active',
                    'version' => '1.0.0',
                    'last_test' => now()->format('Y-m-d')
                ]
            ]
        ]);
    }
}

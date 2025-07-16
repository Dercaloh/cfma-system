<?php

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use App\Models\Assets\AssetType;
use App\Http\Requests\Assets\StoreAssetTypeRequest;
use App\Http\Requests\Assets\UpdateAssetTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Controlador para la gestión de tipos de activos.
 *
 * Cumple normativa legal colombiana aplicable a entidades públicas.
 * Aplica control de acceso, validación, auditoría y seguridad.
 *
 * @package App\Http\Controllers\Assets
 */
class AssetTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:gestionar tipos de activos');
    }

    /**
     * Listar tipos de activos con filtros y paginación.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $search = $request->get('search', '');
            $perPage = in_array($request->get('per_page'), [5, 10, 15, 25, 50]) ? $request->get('per_page') : 25;
            $status = in_array($request->get('status'), ['all', 'active', 'inactive']) ? $request->get('status') : 'all';
            $showDeleted = $request->boolean('show_deleted', false);

            // Consulta base
            $query = AssetType::query();

            // Si se deben incluir eliminados, se agregan con withTrashed()
            if ($showDeleted) {
                $query->withTrashed();
            }

            // Filtro de búsqueda (nombre o descripción)
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            }

            // Filtrar por estado solo si no se está listando eliminados exclusivamente
            if ($status === 'active') {
                $query->where('active', true);
            } elseif ($status === 'inactive') {
                $query->where('active', false);
            }

            // Orden y paginación
            $assetTypes = $query->orderBy('name')->paginate($perPage)->withQueryString();

            // Estadísticas
            $stats = [
                'total'    => AssetType::withTrashed()->count(),
                'active'   => AssetType::where('active', true)->count(),
                'inactive' => AssetType::where('active', false)->count(),
                'deleted'  => AssetType::onlyTrashed()->count(),
                'today'    => AssetType::whereDate('created_at', now()->toDateString())->count(),
            ];

            // Auditoría
            Log::info('Listado de tipos de activos accedido.', [
                'user_id'       => Auth::id(),
                'search'        => $search,
                'status'        => $status,
                'show_deleted'  => $showDeleted,
                'per_page'      => $perPage,
                'total_results' => $assetTypes->total(),
            ]);

            return view('modules.activos.tipos.index', compact(
                'assetTypes',
                'search',
                'status',
                'perPage',
                'stats',
                'showDeleted'
            ));
        } catch (\Exception $e) {
            Log::error('Error en index de tipos de activos.', [
                'user_id' => Auth::id(),
                'error'   => $e->getMessage(),
            ]);

            return redirect()->route('tipos_activos.index')
                ->with('error', 'Error al cargar tipos de activos. Contacte al administrador.');
        }
    }




    /**
     * Mostrar formulario de creación.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            Log::info('Formulario de creación accedido.', [
                'user_id' => Auth::id(),
            ]);
            return view('modules.activos.tipos.create');
        } catch (\Exception $e) {
            Log::error('Error al acceder al formulario de creación.', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('tipos_activos.index')
                ->with('error', 'Error al cargar el formulario de creación.');
        }
    }

    /**
     * Guardar un nuevo tipo de activo.
     *
     * @param StoreAssetTypeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAssetTypeRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            $assetType = AssetType::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'active' => $validated['active'] ?? true,
            ]);

            Log::info('Tipo de activo creado.', [
                'user_id' => Auth::id(),
                'asset_type_id' => $assetType->id,
            ]);

            return redirect()->route('tipos_activos.index')
                ->with('success', "Tipo de activo '{$assetType->name}' creado correctamente.");
        } catch (\Exception $e) {
            Log::error('Error al crear tipo de activo.', [
                'user_id' => Auth::id(),
                'input' => $request->except(['_token', '_method']),
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->withInput()
                ->with('error', 'No se pudo crear el tipo de activo.');
        }
    }

    /**
     * Ver detalles de un tipo de activo.
     *
     * @param AssetType $assetType
     * @return View|RedirectResponse
     */
    public function show(AssetType $assetType): View|RedirectResponse
    {
        try {
            $stats = [
                'total_assets' => $assetType->assets()->count(),
                'active_assets' => 0,
                'inactive_assets' => 0,
            ];

            Log::info('Detalle de tipo de activo accedido.', [
                'user_id' => Auth::id(),
                'asset_type_id' => $assetType->id,
            ]);

            return view('modules.activos.tipos.show', compact('assetType', 'stats'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar detalle de tipo de activo.', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('admin.tipos_activos.index')
                ->with('error', 'Error al cargar detalles del tipo de activo.');
        }
    }


    /**
     * Formulario para editar un tipo de activo.
     *
     * @param AssetType $assetType
     * @return View|RedirectResponse
     */
    public function edit(AssetType $assetType): View|RedirectResponse
    {
        try {
            Log::info('Formulario de edición accedido.', [
                'user_id' => Auth::id(),
                'asset_type_id' => $assetType->id,
            ]);

            return view('modules.activos.tipos.edit', compact('assetType'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar formulario de edición.', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('tipos_activos.index')
                ->with('error', 'No se pudo acceder al formulario de edición.');
        }
    }

    /**
     * Actualizar tipo de activo existente.
     *
     * @param UpdateAssetTypeRequest $request
     * @param AssetType $assetType
     * @return RedirectResponse
     */
    public function update(UpdateAssetTypeRequest $request, AssetType $assetType): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $originalData = $assetType->only(['name', 'description', 'active']);

            $assetType->update([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'active' => $validated['active'] ?? true,
            ]);

            Log::info('Tipo de activo actualizado.', [
                'user_id' => Auth::id(),
                'asset_type_id' => $assetType->id,
                'changes' => ['from' => $originalData, 'to' => $validated],
            ]);

            return redirect()->route('tipos_activos.index')
                ->with('success', "Tipo de activo '{$assetType->name}' actualizado correctamente.");
        } catch (\Exception $e) {
            Log::error('Error al actualizar tipo de activo.', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->withInput()
                ->with('error', 'Error al actualizar el tipo de activo.');
        }
    }

    /**
     * Eliminar tipo de activo (soft delete).
     *
     * @param AssetType $assetType
     * @return RedirectResponse
     */
    public function destroy(AssetType $assetType): RedirectResponse
    {
        try {
            $assetsCount = $assetType->assets()->count();

            if ($assetsCount > 0) {
                Log::warning('Eliminación bloqueada: tipo con activos asociados.', [
                    'user_id' => Auth::id(),
                    'asset_type_id' => $assetType->id,
                    'associated_assets' => $assetsCount,
                ]);

                return redirect()->route('admin.tipos_activos.index')
                    ->with('error', "No se puede eliminar el tipo '{$assetType->name}' porque tiene activos asociados.");
            }

            $deletedData = $assetType->only(['id', 'name', 'description', 'active']);

            $assetType->delete();

            Log::info('Tipo de activo eliminado (soft delete).', [
                'user_id' => Auth::id(),
                'deleted_data' => $deletedData,
            ]);

            return redirect()->route('admin.tipos_activos.index')
                ->with('success', "Tipo de activo '{$assetType->name}' eliminado correctamente.");
        } catch (\Exception $e) {
            Log::error('Error al eliminar tipo de activo.', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('admin.tipos_activos.index')
                ->with('error', 'No se pudo eliminar el tipo de activo.');
        }
    }
    /**
     * Restaurar tipo de activo eliminado (soft delete).
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        try {
            $assetType = AssetType::onlyTrashed()->findOrFail($id);

            // Verificar que el nombre no esté en uso por otro registro activo
            $existingActive = AssetType::where('name', $assetType->name)
                ->whereNull('deleted_at')
                ->exists();

            if ($existingActive) {
                Log::warning('Restauración bloqueada: nombre ya existe en registro activo.', [
                    'user_id' => Auth::id(),
                    'asset_type_id' => $id,
                    'name' => $assetType->name,
                ]);

                return redirect()->back()
                    ->with('error', "No se puede restaurar '{$assetType->name}' porque ya existe un tipo activo con ese nombre.");
            }

            $restoredData = $assetType->only(['id', 'name', 'description', 'active']);
            $assetType->restore();

            Log::info('Tipo de activo restaurado.', [
                'user_id' => Auth::id(),
                'restored_data' => $restoredData,
            ]);

            return redirect()->route('tipos_activos.index')
                ->with('success', "Tipo de activo '{$assetType->name}' restaurado correctamente.");
        } catch (ModelNotFoundException $e) {
            Log::error('Tipo de activo eliminado no encontrado para restaurar.', [
                'user_id' => Auth::id(),
                'asset_type_id' => $id,
            ]);

            return redirect()->back()
                ->with('error', 'El tipo de activo no existe o no está eliminado.');
        } catch (\Exception $e) {
            Log::error('Error al restaurar tipo de activo.', [
                'user_id' => Auth::id(),
                'asset_type_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()
                ->with('error', 'No se pudo restaurar el tipo de activo.');
        }
    }
}

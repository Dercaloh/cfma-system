<?php

namespace App\Exports;

use App\Exports\Sheets\UsersSheetExport;
use App\Exports\Sheets\DepartmentsSheetExport;
use App\Exports\Sheets\PositionsSheetExport;
use App\Exports\Sheets\BranchesSheetExport;
use App\Exports\Sheets\LocationsSheetExport;
use App\Exports\Sheets\InstructionsSheetExport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Exportador de plantillas Excel para importación masiva de usuarios
 *
 * Cumple con:
 * - Ley 1581 de 2012 (Protección de datos)
 * - ISO 27001 (Seguridad de la información)
 * - Resolución 1122 de 2023 (Accesibilidad)
 * - Decreto 1080 de 2015 (Formatos estándar)
 */
class TemplateExport implements WithMultipleSheets
{
    /**
     * Datos de la plantilla
     */
    protected array $templateData;

    /**
     * Colores institucionales
     */
    const SENA_GREEN   = '39A900';
    const SENA_ORANGE  = 'FF6900';
    const SENA_GRAY    = '666666';
    const LIGHT_GRAY   = 'F5F5F5';
    const WHITE        = 'FFFFFF';

    /**
     * Constructor
     */
    public function __construct(array $templateData)
    {
        $this->templateData = $templateData;
    }

    /**
     * Retorna las hojas del Excel
     */
    public function sheets(): array
    {
        try {
            $sheets = [];

            // Hoja principal de usuarios
            if (!empty($this->templateData['Usuarios'])) {
                $sheets[] = new UsersSheetExport($this->templateData['Usuarios']);
            }

            // Hojas de catálogo
            if (!empty($this->templateData['Departamentos'])) {
                $sheets[] = new DepartmentsSheetExport($this->templateData['Departamentos']);
            }

            if (!empty($this->templateData['Cargos'])) {
                $sheets[] = new PositionsSheetExport($this->templateData['Cargos']);
            }

            if (!empty($this->templateData['Sedes'])) {
                $sheets[] = new BranchesSheetExport($this->templateData['Sedes']);
            }

            if (!empty($this->templateData['Ubicaciones'])) {
                $sheets[] = new LocationsSheetExport($this->templateData['Ubicaciones']);
            }

            // Hoja de instrucciones
            if (!empty($this->templateData['Instrucciones'])) {
                $sheets[] = new InstructionsSheetExport($this->templateData['Instrucciones']);
            }

            // Log institucional
            Log::info('Plantilla Excel generada correctamente', [
                'user_id' => Auth::id(),
                'sheets' => count($sheets),
                'timestamp' => now()->toISOString(),
                'classification' => 'classified' // 🟡
            ]);

            return $sheets;

        } catch (\Throwable $e) {
            Log::error('Error al generar plantilla Excel', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
                'classification' => 'reserved' // 🔴
            ]);

            throw new \Exception('Error generando plantilla Excel: ' . $e->getMessage());
        }
    }

    /**
     * Validar estructura de datos de plantilla
     */
    public static function validateTemplateData(array $templateData): bool
    {
        $requiredKeys = ['Usuarios', 'Departamentos', 'Cargos', 'Sedes', 'Ubicaciones', 'Instrucciones'];

        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $templateData)) {
                throw new \Exception("Falta la clave requerida: '{$key}'");
            }
        }

        if (empty($templateData['Usuarios'])) {
            throw new \Exception("Debe proporcionar al menos un usuario de ejemplo.");
        }

        if (empty($templateData['Instrucciones'])) {
            throw new \Exception("Debe incluir instrucciones claras para el diligenciamiento.");
        }

        return true;
    }

    /**
     * Información institucional de la plantilla
     */
    public function getTemplateInfo(): array
    {
        return [
            'sheets' => [
                'Usuarios_Importacion' => 'Hoja principal para importar usuarios',
                'Departamentos'       => 'Catálogo de departamentos disponibles',
                'Cargos'              => 'Catálogo de cargos disponibles',
                'Sedes'               => 'Catálogo de sedes disponibles',
                'Ubicaciones'         => 'Catálogo de ubicaciones disponibles',
                'Instrucciones'       => 'Guía detallada de diligenciamiento'
            ],
            'features' => [
                'Validación de datos en tiempo real',
                'Comentarios explicativos',
                'Columnas ajustadas',
                'Diseño accesible y conforme al SENA',
                'Encabezado institucional y metadatos'
            ],
            'compliance' => [
                'Ley 1581 de 2012',
                'ISO/IEC 27001',
                'Resolución 1122 de 2023 (MinTIC)',
                'Decreto 1080 de 2015'
            ]
        ];
    }
}

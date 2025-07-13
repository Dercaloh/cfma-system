<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use App\Exports\TemplateExport;

/**
 * Hoja de Cargos para la plantilla Excel
 *
 * Cumple con:
 * - ISO 27001 (Seguridad de la información)
 * - Resolución 1122 de 2023 (Accesibilidad)
 * - Decreto 1080 de 2015 (Formatos estándar)
 *
 * @package App\Exports\Sheets
 */
class PositionsSheetExport implements FromArray, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    protected array $data;

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Datos a exportar
     *
     * @return array
     */
    public function array(): array
    {
        return $this->data;
    }

    /**
     * Título de la hoja
     *
     * @return string
     */
    public function title(): string
    {
        return 'Cargos';
    }

    /**
     * Encabezados de columna
     *
     * @return array
     */
    public function headings(): array
    {
        return ['ID', 'Nombre', 'Descripción'];
    }

    /**
     * Estilos del encabezado
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'],
                    'size' => 12,
                    'name' => 'Work Sans'
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['argb' => TemplateExport::SENA_GREEN]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]
        ];
    }
}

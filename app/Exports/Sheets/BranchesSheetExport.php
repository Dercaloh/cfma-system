<?php

namespace App\Exports\Sheets;

use App\Exports\TemplateExport;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

/**
 * Hoja de Sedes para la plantilla de importación SGPTI
 *
 * Cumple con diseño institucional y accesibilidad.
 */
class BranchesSheetExport implements FromArray, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    protected array $branches;

    /**
     * Constructor
     *
     * @param array $branches
     */
    public function __construct(array $branches)
    {
        $this->branches = $branches;
    }

    /**
     * Datos de la hoja
     *
     * @return array
     */
    public function array(): array
    {
        return $this->branches;
    }

    /**
     * Título de la hoja
     *
     * @return string
     */
    public function title(): string
    {
        return 'Sedes';
    }

    /**
     * Encabezados de columnas
     *
     * @return array
     */
    public function headings(): array
    {
        return ['ID', 'Nombre', 'Código'];
    }

    /**
     * Estilos de la hoja
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
                    'name' => 'Work Sans',
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => TemplateExport::SENA_GREEN]
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'CCCCCC']
                    ]
                ]
            ]
        ];
    }
}

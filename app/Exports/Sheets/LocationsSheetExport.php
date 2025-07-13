<?php

namespace App\Exports\Sheets;

use App\Exports\TemplateExport;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

/**
 * Hoja de Ubicaciones para la plantilla SGPTI
 *
 * Cumple diseño institucional SENA y criterios de accesibilidad
 */
class LocationsSheetExport implements FromArray, WithTitle, WithHeadings, WithStyles, ShouldAutoSize
{
    protected array $locations;

    /**
     * Constructor
     *
     * @param array $locations
     */
    public function __construct(array $locations)
    {
        $this->locations = $locations;
    }

    /**
     * Datos de la hoja
     */
    public function array(): array
    {
        return $this->locations;
    }

    /**
     * Título de la hoja
     */
    public function title(): string
    {
        return 'Ubicaciones';
    }

    /**
     * Encabezados de columna
     */
    public function headings(): array
    {
        return ['ID', 'Nombre', 'Código'];
    }

    /**
     * Estilos personalizados
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
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['argb' => TemplateExport::SENA_GREEN],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'   => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'CCCCCC'],
                    ],
                ],
            ],
        ];
    }
}

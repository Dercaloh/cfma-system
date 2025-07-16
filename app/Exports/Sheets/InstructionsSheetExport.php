<?php

namespace App\Exports\Sheets;

use App\Exports\TemplateExport;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

/**
 * Hoja de Instrucciones de la plantilla de usuarios SGPTI
 *
 * Cumple criterios de accesibilidad y diseño institucional SENA
 */
class InstructionsSheetExport implements FromArray, WithTitle, WithHeadings, WithStyles, WithColumnWidths, WithEvents
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

    public function array(): array
    {
        return $this->data;
    }

    public function title(): string
    {
        return 'Instrucciones';
    }

    public function headings(): array
    {
        return ['Campo', 'Descripción', 'Valores Permitidos', 'Requerido', 'Ejemplo'];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 40,
            'C' => 35,
            'D' => 12,
            'E' => 25,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            4 => [ // fila de encabezado de campos
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'],
                    'size' => 12,
                    'name' => 'Work Sans',
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['argb' => TemplateExport::SENA_GRAY],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Ajustar altura de filas
                $sheet->getDefaultRowDimension()->setRowHeight(20);
                $sheet->getRowDimension(4)->setRowHeight(30);

                // Wrap de contenido
                $lastRow = count($this->data) + 4;
                $sheet->getStyle("A5:E{$lastRow}")
                    ->getAlignment()
                    ->setWrapText(true)
                    ->setVertical(Alignment::VERTICAL_TOP);

                $this->addInstitutionalHeader($sheet);
            }
        ];
    }

    /**
     * Agregar encabezado institucional CFMA - SENA
     */
    private function addInstitutionalHeader(Worksheet $sheet): void
    {
        // Insertar 3 filas arriba
        $sheet->insertNewRowBefore(1, 3);

        // Título principal
        $sheet->setCellValue('A1', 'SERVICIO NACIONAL DE APRENDIZAJE - SENA');
        $sheet->mergeCells('A1:E1');

        // Subtítulo
        $sheet->setCellValue('A2', 'Centro de Formación Minero Ambiental (CFMA)');
        $sheet->mergeCells('A2:E2');

        // Descripción
        $sheet->setCellValue('A3', 'Plantilla para Importación Masiva de Usuarios - Instrucciones');
        $sheet->mergeCells('A3:E3');

        // Estilo del encabezado
        $sheet->getStyle('A1:E3')->applyFromArray([
            'font' => [
                'bold' => true,
                'name' => 'Work Sans',
                'size' => 14,
                'color' => ['argb' => TemplateExport::SENA_GREEN],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['argb' => TemplateExport::LIGHT_GRAY],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => TemplateExport::SENA_GREEN],
                ]
            ]
        ]);

        // Ajustar altura
        $sheet->getRowDimension(1)->setRowHeight(25);
        $sheet->getRowDimension(2)->setRowHeight(20);
        $sheet->getRowDimension(3)->setRowHeight(25);
    }
}

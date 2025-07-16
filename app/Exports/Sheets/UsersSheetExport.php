<?php

namespace App\Exports\sheets;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use App\Exports\TemplateExport;

class UsersSheetExport implements FromArray, WithTitle, WithHeadings, WithStyles, WithColumnWidths, WithEvents, ShouldAutoSize
{
    protected array $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function array(): array
    {
        return $this->users;
    }

    public function title(): string
    {
        return 'Usuarios_Importacion';
    }

    public function headings(): array
    {
        return [
            'document_type',
            'identification_number',
            'first_name',
            'last_name',
            'username',
            'email',
            'password',
            'employee_id',
            'position_id',
            'phone_number',
            'personal_email',
            'institutional_email',
            'department_id',
            'branch_id',
            'location_id',
            'status',
            'account_valid_from',
            'account_valid_until'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18, 'B' => 20, 'C' => 25, 'D' => 25,
            'E' => 20, 'F' => 30, 'G' => 20, 'H' => 15,
            'I' => 15, 'J' => 18, 'K' => 30, 'L' => 30,
            'M' => 18, 'N' => 15, 'O' => 15, 'P' => 12,
            'Q' => 18, 'R' => 18,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF'], 'size' => 12, 'name' => 'Work Sans'],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['argb' => TemplateExport::SENA_GREEN]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => '000000']]]
            ],
            'A2:R1000' => [
                'font' => ['name' => 'Calibri', 'size' => 11],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'CCCCCC']]]
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $this->setDataValidations($sheet);
                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->freezePane('A2');
                $this->addComments($sheet);
            }
        ];
    }

    private function setDataValidations(Worksheet $sheet): void
    {
        $validation = $sheet->getCell('A2')->getDataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setFormula1('"CC,TI,CE,NIT,PAS"');
        $validation->setPromptTitle('Tipo de Documento');
        $validation->setPrompt('Seleccione el tipo de documento');
        $validation->setErrorTitle('Error');
        $validation->setError('Debe seleccionar un tipo de documento válido');
        $sheet->setDataValidation('A2:A1000', clone $validation);

        $statusValidation = $sheet->getCell('P2')->getDataValidation();
        $statusValidation->setType(DataValidation::TYPE_LIST);
        $statusValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
        $statusValidation->setAllowBlank(false);
        $statusValidation->setShowInputMessage(true);
        $statusValidation->setShowErrorMessage(true);
        $statusValidation->setShowDropDown(true);
        $statusValidation->setFormula1('"activo,inactivo,suspendido"');
        $statusValidation->setPromptTitle('Estado del Usuario');
        $statusValidation->setPrompt('Seleccione el estado del usuario');
        $statusValidation->setErrorTitle('Error');
        $statusValidation->setError('Debe seleccionar un estado válido');
        $sheet->setDataValidation('P2:P1000', clone $statusValidation);
    }

    private function addComments(Worksheet $sheet): void
    {
        $sheet->getComment('F1')->getText()->createTextRun('Email institucional único. Formato: usuario@sena.edu.co');
        $sheet->getComment('G1')->getText()->createTextRun('Contraseña temporal. Mínimo 8 caracteres con mayúscula, minúscula, número y carácter especial');
        $sheet->getComment('Q1')->getText()->createTextRun('Formato: YYYY-MM-DD (Ej: 2024-01-15)');
        $sheet->getComment('R1')->getText()->createTextRun('Formato: YYYY-MM-DD (Ej: 2024-12-31)');
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JobApplicationExport implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data;
    }

    /**
     * Map each row to add clickable hyperlinks for CV
     */
    public function map($row): array
    {
        // Generate clickable links for CV
        $row->cv = '=HYPERLINK("' . asset($row->cv) . '", "Click Here")';

        return (array) $row; // Convert object to array for export
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Career',
            'Full Name',
            'Gender',
            'Date of Birth (B.S.)',
            'Date of Birth (A.D.)',
            'Age',
            'Current Address',
            'Mobile No.',
            'Email',
            'Phone No.',
            'Highest Education Qualification',
            'Cover Letter',
            'CV',
        ];
    }
}

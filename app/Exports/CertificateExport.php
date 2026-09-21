<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CertificateExport implements FromCollection, WithHeadings, WithMapping
{
    protected Collection $certificates;

    public function __construct(Collection $certificates)
    {
        $this->certificates = $certificates;
    }

    public function collection()
    {
        return $this->certificates;
    }

    public function headings(): array
    {
        return [
            'Cédula estudiante',
            'Nombre estudiante',
            'Curso',
            'Horas del curso',
            'Fecha de expedición',
            'Fecha de vencimiento',
        ];
    }

    public function map($certificate): array
    {
        return [
            $certificate->students['id'] ?? $certificate->students_id,
            $certificate->students['student_name'] ?? '',
            $certificate->courses['course_name'] ?? '',
            $certificate->courses['course_duration'] ?? '',
            date('d-m-Y', strtotime($certificate->certificate_expedition)),
            $certificate->vencimiento->format('d-m-Y'),
        ];
    }
}

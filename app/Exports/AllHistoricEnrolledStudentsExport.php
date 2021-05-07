<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllHistoricEnrolledStudentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'ID',
            'Nombres',
            'Apellidos',
            'Identificación',
            'Celular',
            'Email',
            'Ciudad',
            'Estado / Dpto',
            'País',
            'Estado',
            'Thinkific ID',
            'Fecha de creación',
            'Fecha de actualización',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::where('status', 'enrolled')->get();
    }
}

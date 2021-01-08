<?php

namespace App\Exports;

use App\ExternalApis\ThinkificApi;
use App\Models\Course;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompletedEnrollmentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct(Course $course)
    {

        $this->students = $this->getEnrolledStudentsWhoCompleted($course);

    }

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

        return Student::whereIn('email', $this->students)->get();

    }

    public function getEnrolledStudentsWhoCompleted($course)
    {

        $enrolledStudents = [];

        $page = 1;

        $totalPages = 0;

        do {

            $response = ThinkificApi::getEnrolledStudentsWhoCompleted($course->thinkific_id, $page);

            $enrolledStudents = array_merge($enrolledStudents, $response['items']);

            $totalPages++;

            $page++;

        } while ($response['meta']['pagination']['total_pages'] > $totalPages);

        return array_column($enrolledStudents, 'user_email');

    }
}

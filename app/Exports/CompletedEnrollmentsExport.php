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
    private const COMPLETION_PERCENTAGE = 0.95;

    public function __construct(Course $course)
    {

        $this->students = $this->getEnrolledStudentsWhoCompleted($course);

    }

    public function headings(): array
    {
        return [
            'Nombres',
            'Apellidos',
            'Identificación',
            'Celular',
            'Email',
            'Ciudad',
            'Estado / Dpto',
            'País',
            'Fecha de creación',
            'Fecha de actualización',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $fields = [
            'name', 'last_name', 'identification',
            'phone', 'email', 'city', 'state',
            'country', 'created_at', 'updated_at'
        ];

        return Student::whereIn('email', $this->students)
            ->select($fields)
            ->orderBy('country')
            ->orderBy('state')
            ->orderBy('city')
            ->orderBy('updated_at')
            ->get();

    }

    public function getEnrolledStudentsWhoCompleted($course)
    {

        $enrolledStudents = [];

        $page = 1;

        $totalPages = 0;

        do {

            $response = ThinkificApi::getEnrolledStudentsWhoCompleted($course->thinkific_id, $page);

            $completed = array_filter($response['items'], function ($student) {
                return floatval($student['percentage_completed']) >= self::COMPLETION_PERCENTAGE;
            });

            $enrolledStudents = array_merge($enrolledStudents, $completed);

            $totalPages++;

            $page++;

        } while ($response['meta']['pagination']['total_pages'] > $totalPages);

        return array_column($enrolledStudents, 'user_email');

    }
}

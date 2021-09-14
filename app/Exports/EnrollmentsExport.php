<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\Student;
use App\ExternalApis\ThinkificApi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EnrollmentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    private Course $course;

    private array $especialCourses = ['Connection', 'LVR School'];

    private bool $withLeader = false;

    public function __construct(Course $course)
    {
        $this->course = $course;

        $this->withLeader = in_array($this->course->name, $this->especialCourses);

        $this->students = $this->getCourseEnrolledStudents();
    }

    public function headings(): array
    {
        if ($this->withLeader) {
            return [
                'Nombre',
                'Apellidos',
                'Celular',
                'Email',
                'Ciudad',
                'Estado / Dpto',
                'País',
                'Líder',
            ];
        } else {
            return [
                'ID',
                'Nombre',
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
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {

        if ($this->withLeader) {
            $selectFields = [
                'students.name', 'students.last_name',
                'students.phone', 'students.email', 'students.city', 'students.state',
                'students.country', 'leaders.name as leader'
            ];

            return Student::query()
                ->whereIn('email', $this->students)
                ->whereHas('courses', function (Builder $query) {
                    dd($this->course);
                    $query->where('courses.id', $this->course->id);
                })
                ->join('leader_student', 'students.id', '=', 'leader_student.student_id')
                ->join('leaders', 'leaders.id', '=', 'leader_student.leader_id')
                ->select($selectFields)
                ->orderBy('students.updated_at')
                ->get();
        } else {
            return Student::whereIn('email', $this->students)->get();
        }

    }

    public function getCourseEnrolledStudents(): array
    {

        $enrolledStudents = [];

        $page = 1;

        $totalPages = 0;

        do {

            $response = ThinkificApi::getEnrolledStudents($this->course->thinkific_id, $page);

            $enrolledStudents = array_merge($enrolledStudents, $response['items']);

            $totalPages++;

            $page++;

        } while ($response['meta']['pagination']['total_pages'] > $totalPages);

        return array_column($enrolledStudents, 'user_email');

    }
}

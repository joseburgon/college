<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\Student;
use App\Repositories\ThinkificApi;
use Maatwebsite\Excel\Concerns\FromCollection;

class EnrollmentsExport implements FromCollection
{
    public function __construct(Course $course)
    {

        $this->students = $this->getCourseEnrolledStudents($course);

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return Student::whereIn('email', $this->students)->get();

    }

    public function getCourseEnrolledStudents($course)
    {

        $enrolledStudents = [];

        $apiRepo = new ThinkificApi();

        $page = 1;

        $totalPages = 0;

        do {

            $response = $apiRepo->getEnrolledStudents($course->thinkific_id, $page);

            $enrolledStudents = array_merge($enrolledStudents, $response['items']);

            $totalPages++;

            $page++;

        } while ($response['meta']['pagination']['total_pages'] > $totalPages);

        return array_column($enrolledStudents, 'user_email');

    }
}

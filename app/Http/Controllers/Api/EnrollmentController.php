<?php

namespace App\Http\Controllers\Api;

use App\Exports\AllHistoricEnrolledStudentsExport;
use App\Exports\CompletedEnrollmentsExport;
use App\Models\Course;
use App\Exports\EnrollmentsExport;
use App\Exports\NotEnrolledStudentsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class EnrollmentController extends Controller
{
    public function exportCurrent(Course $course)
    {
        $fileName = str_replace(' ', '_', $course->name) . '_Matriculados_' . date("Ymd_His") . '.xlsx';

        return Excel::download(new EnrollmentsExport($course), $fileName);
    }

    public function exportCompleted(Course $course)
    {
        $fileName = str_replace(' ', '_', $course->name) . '_Completados_' . date("Ymd_His") . '.xlsx';

        return Excel::download(new CompletedEnrollmentsExport($course), $fileName);
    }

    public function notEnrolledExport()
    {
        $fileName = 'No_Matriculados_' . date("Ymd_His") . '.xlsx';

        return Excel::download(new NotEnrolledStudentsExport, $fileName);
    }

    public function allHistoricEnrolledExport()
    {
        $fileName = 'Todos_Los_Estudiantes_' . date("Ymd_His") . '.xlsx';

        return Excel::download(new AllHistoricEnrolledStudentsExport, $fileName);
    }
}

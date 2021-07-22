<?php

namespace App\Http\Controllers\Api;

use App\Exports\AllHistoricEnrolledStudentsExport;
use App\Exports\CompletedEnrollmentsExport;
use App\Exports\ConnectionStudentsExport;
use App\Models\Course;
use App\Exports\EnrollmentsExport;
use App\Exports\NotEnrolledStudentsExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class EnrollmentController extends Controller
{
    private Carbon $now;

    public function __construct()
    {
        $this->now = Carbon::now('America/Bogota');
    }

    public function exportCurrent(Course $course)
    {
        $fileName = str_replace(' ', '_', $course->name) . '_Matriculados_' . $this->now->format("Ymd_His") . '.xlsx';

        return Excel::download(new EnrollmentsExport($course), $fileName);
    }

    public function exportCompleted(Course $course)
    {
        $fileName = str_replace(' ', '_', $course->name) . '_Completados_' . $this->now->format("Ymd_His") . '.xlsx';

        return Excel::download(new CompletedEnrollmentsExport($course), $fileName);
    }

    public function notEnrolledExport()
    {
        $fileName = 'No_Matriculados_' . $this->now->format("Ymd_His") . '.xlsx';

        return Excel::download(new NotEnrolledStudentsExport, $fileName);
    }

    public function allHistoricEnrolledExport()
    {
        $fileName = 'Todos_Los_Estudiantes_' . $this->now->format("Ymd_His") . '.xlsx';

        return Excel::download(new AllHistoricEnrolledStudentsExport, $fileName);
    }

    public function exportConnection()
    {
        $fileName = 'Connection_Matriculados_' . $this->now->format("Ymd_His") . '.xlsx';

        return Excel::download(new ConnectionStudentsExport(), $fileName);
    }
}

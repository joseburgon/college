<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Exports\EnrollmentsExport;
use App\Exports\NotEnrolledStudentsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class EnrollmentController extends Controller
{
    public function export(Course $course)
    {
        $fileName = str_replace(' ', '_', $course->name) . '_Matriculados_' . date("Ymd_His") . '.xlsx';

        return Excel::download(new EnrollmentsExport($course), $fileName);
    }

    public function notEnrolledExport()
    {
        $fileName = 'No_Matriculados_' . date("Ymd_His") . '.xlsx';

        return Excel::download(new NotEnrolledStudentsExport, $fileName);
    }
}

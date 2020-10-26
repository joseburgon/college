<?php

namespace App\Http\Controllers\Api;

use App\Events\EnrollmentsUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Imports\StudentsImport;
use App\Models\Course;
use App\Models\ReferenceCode;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::limit(50)->get();
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $student = Student::updateOrCreate(['email' => $request['email']],
            [
                'identification' => $request['identification'],
                'name' => $request['name'],
                'last_name' => $request['last_name'],
                'phone' => $request['phone'],
                'city' => $request['city'],
                'state' => $request['state'],
                'country' => $request['country'],
            ]
        );

        return response()->json($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($identification)
    {
        $student = Student::where('identification', $identification)->first();

        return response()->json(['student' => $student]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:1024|mimes:xls,xlsx,csv',
        ]);

        Excel::import(new StudentsImport, request()->file('file'));

        return response()->json(['message' => '¡Archivo importado exitosamente!']);
    }
}

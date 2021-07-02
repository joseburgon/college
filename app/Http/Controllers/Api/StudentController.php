<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Imports\StudentsImport;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::limit(50)->get();
        return response()->json($students);
    }

    public function store(StudentRequest $request)
    {
        $student = Student::updateOrCreate(['email' => $request['email']],
            [
                'identification' => $request['identification'] ?? 'NO REGISTRA',
                'name' => $request['name'],
                'last_name' => $request['last_name'],
                'phone' => $request['phone'],
                'city' => $request['city'],
                'state' => $request['state'],
                'country' => $request['country'],
            ]
        );

        $student->leaders()->sync($request['leader_id']);

        return response()->json($student);
    }

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

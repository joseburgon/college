<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name' => $row[0],
            'last_name' => $row[1],
            'identification' => $row[2],
            'phone' => $row[3],
            'email' => $row[4],
            'city' => $row[5],
            'state' => $row[6],
            'country' => $row[7],
            'status' => $row[8],
            'thinkific_user_id' => $row[9],
        ]);
    }
}

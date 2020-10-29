<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($this->studentExists($row)) {

            return null;

        } else {

            return new Student([
                'name' => $row['name'],
                'last_name' => $row['last_name'],
                'identification' => $row['identification'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'city' => $row['city'],
                'state' => $row['state'],
                'country' => $row['country'],
                'status' => $row['status'],
                'thinkific_user_id' => $row['thinkific_user_id'],
            ]);

        }
    }

    private function studentExists($studentRow)
    {
        $student = Student::firstWhere('email', $studentRow['email']);

        if ($student <> null) {

            Log::info('Imported student found.', (array) $student);

            $student->update($studentRow);

            return true;

        } else {

            return false;

        }
    }
}

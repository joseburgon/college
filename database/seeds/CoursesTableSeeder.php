<?php

use App\Models\Course;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' => 'Curso Básico',
            'cohort' => 'Septiembre 2020'
        ]);

        Course::create([
            'name' => 'Curso de Finanzas',
            'cohort' => 'Agosto 2020'
        ]);
    }
}

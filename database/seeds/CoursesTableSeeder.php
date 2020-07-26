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
            'tagline' => 'SCHOOL PATH',
            'description' => 'Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.',
            'cohort' => 'Septiembre 2020',
            'thinkific_id' => 761932
        ]);

        Course::create([
            'name' => 'Curso de Finanzas',
            'tagline' => 'De la carencia a la abundancia',
            'description' => 'Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.',
            'cohort' => 'Agosto 2020',
            'thinkific_id' => 761932
        ]);
    }
}

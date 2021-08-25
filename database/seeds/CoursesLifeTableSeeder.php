<?php

use Illuminate\Database\Seeder;
use App\Models\CourseLife;

class CoursesLifeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* FINANZAS */
        CourseLife::create([
            'thinkific_id' => 866807,
            'immediate' => true,
            'activation' => \Carbon\Carbon::now(),
            'duration' => 92,
        ]);

        /* AUTORIDAD ESPIRITUAL */
        CourseLife::create([
            'thinkific_id' => 874120,
            'immediate' => true,
            'activation' => \Carbon\Carbon::now(),
            'duration' => 92,
        ]);

        /* SCHOOL BÁSICO */
        CourseLife::create([
            'thinkific_id' => 884089,
            'immediate' => false,
            'activation' => \Carbon\Carbon::parse('13-09-2021')->timezone('America/Bogota'),
            'duration' => 366,
        ]);

        /* SCHOOL INTERMEDIO */
        CourseLife::create([
            'thinkific_id' => 884124,
            'immediate' => false,
            'activation' => \Carbon\Carbon::parse('25-10-2021')->timezone('America/Bogota'),
            'duration' => 366,
        ]);

        /* SCHOOL COMPLEMENTARIO */
        CourseLife::create([
            'thinkific_id' => 884148,
            'immediate' => false,
            'activation' => \Carbon\Carbon::parse('10-01-2022')->timezone('America/Bogota'),
            'duration' => 366,
        ]);

        /* CONNECTION */
        CourseLife::create([
            'thinkific_id' => 1408949,
            'immediate' => false,
            'activation' => \Carbon\Carbon::parse('01-01-2022')->timezone('America/Bogota'),
            'duration' => 92,
        ]);
    }
}

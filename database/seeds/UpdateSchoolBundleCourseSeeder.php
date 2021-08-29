<?php

use Illuminate\Database\Seeder;

class UpdateSchoolBundleCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fullSchoolProgram = \App\Models\Course::where('name', 'LVR School')->first();

        $fullSchoolProgram->update([
            'thinkific_id' => 1513280,
            'bundle' => null,
        ]);

        $monthlySchoolProgram = \App\Models\Course::create([
            'name' => 'LVR School',
            'tagline' => 'School - Programa Completo (Primer Pago)',
            'description' => 'Este es el programa central de nuestra escuela de formación, en él enseñamos todos los temas fundamentales de la fe con un enfoque de gracia que de manera transversal está presente en todo el contenido. Este programa es la ruta indicada para aprender e interiorizar el ADN de Living Room.',
            'price' => 1600000,
            'price_usd' => 45,
            'discount_percentage' => 0,
            'cohort' => 'Septiembre 2021',
            'thinkific_id' => 1513280,
            'bundle' => null,
            'available_at' => \Carbon\Carbon::create('2021', '08', '15', '00', '00', '00', 'America/Bogota'),
        ]);

        /* SCHOOL COMPLETO - PAGO TOTAL */
        \App\Models\CourseLife::create([
            'course_id' => $fullSchoolProgram->id,
            'thinkific_id' => 1513280,
            'immediate' => true,
            'activation' => now()->timezone('America/Bogota'),
            'duration' => 385,
        ]);

        /* SCHOOL COMPLETO - PAGO MENSUAL */
        \App\Models\CourseLife::create([
            'course_id' => $monthlySchoolProgram->id,
            'thinkific_id' => 1513280,
            'immediate' => true,
            'activation' => now()->timezone('America/Bogota'),
            'duration' => 52,
        ]);
    }
}

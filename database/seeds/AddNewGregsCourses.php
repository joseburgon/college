<?php

use App\Models\Course;
use App\Models\CourseLife;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AddNewGregsCourses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restoreOne = Course::create([
            'name' => 'Restore - Módulo 1',
            'tagline' => 'Primer Módulo del curso Restore dictado por Greg Miller',
            'description' => 'Aprenderemos herramientas para identificar y discernir el origen de las enfermedades y cómo activar y desarrollar el don de sanidad.',
            'price' => 350000,
            'price_usd' => 95,
            'discount_percentage' => 0,
            'cohort' => 'Mayo 2022',
            'bundle' => null,
            'thinkific_id' => 1808353,
            'available_at' => Carbon::create('2022', '05', '15', '00', '00', '00', 'America/Bogota'),
        ]);

        CourseLife::create([
            'course_id' => $restoreOne->id,
            'thinkific_id' => 1808353,
            'immediate' => true,
            'activation' => Carbon::now(),
            'duration' => 60,
        ]);

        $restoreComplete = Course::create([
            'name' => 'Restore - Curso Completo',
            'tagline' => 'Restore: Curso completo dictado por Greg Miller',
            'description' => 'Aprenderemos herramientas para identificar y discernir el origen de las enfermedades y cómo activar y desarrollar el don de sanidad.',
            'price' => 600000,
            'price_usd' => 160,
            'discount_percentage' => 0,
            'cohort' => 'Mayo 2022',
            'bundle' => null,
            'thinkific_id' => 1808412,
            'available_at' => Carbon::create('2022', '05', '15', '00', '00', '00', 'America/Bogota'),
        ]);

        CourseLife::create([
            'course_id' => $restoreComplete->id,
            'thinkific_id' => 1808412,
            'immediate' => true,
            'activation' => Carbon::now(),
            'duration' => 60,
        ]);

        $messengersOne =  Course::create([
            'name' => 'Messengers - Módulo 1',
            'tagline' => 'Primer Módulo del curso Messengers dictado por Greg Miller',
            'description' => 'Un mensajero es aquel que recibe una información de parte de Dios y la entrega. En este curso aprenderemos a afinar nuestros sentidos para percibir de una manera más precisa la voz de Dios para nosotros y para los demás.',
            'price' => 350000,
            'price_usd' => 95,
            'discount_percentage' => 0,
            'cohort' => 'Mayo 2022',
            'bundle' => null,
            'thinkific_id' => 1808431,
            'available_at' => Carbon::create('2022', '05', '22', '00', '00', '00', 'America/Bogota'),
        ]);

        CourseLife::create([
            'course_id' => $messengersOne->id,
            'thinkific_id' => 1808431,
            'immediate' => true,
            'activation' => Carbon::now(),
            'duration' => 60,
        ]);

        $messengersComplete = Course::create([
            'name' => 'Messengers - Curso Completo',
            'tagline' => 'Messengers: curso completo dictado por Greg Miller',
            'description' => 'Un mensajero es aquel que recibe una información de parte de Dios y la entrega. En este curso aprenderemos a afinar nuestros sentidos para percibir de una manera más precisa la voz de Dios para nosotros y para los demás.',
            'price' => 600000,
            'price_usd' => 160,
            'discount_percentage' => 0,
            'cohort' => 'Mayo 2022',
            'bundle' => null,
            'thinkific_id' => 1808468,
            'available_at' => Carbon::create('2022', '05', '22', '00', '00', '00', 'America/Bogota'),
        ]);

        CourseLife::create([
            'course_id' => $messengersComplete->id,
            'thinkific_id' => 1808468,
            'immediate' => true,
            'activation' => Carbon::now(),
            'duration' => 60,
        ]);
    }
}

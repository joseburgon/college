<?php

use App\Models\Course;
use App\Models\CourseLife;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AddNewDLCALAPromoCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' => 'Curso de Finanzas + Libro',
            'tagline' => 'De la carencia a la abundancia',
            'description' => '¿Has escuchado esa frase que dice “el dinero llama al dinero”?, es una gran verdad,  la riqueza interior llama a la riqueza material porque atraemos lo que somos. Tu y yo fuimos diseñados para florecer y prosperar en todas las áreas de nuestra vida por eso hay semillas de grandeza en nuestro interior.',
            'price' => 300000,
            'price_usd' => 80,
            'discount_percentage' => 15,
            'cohort' => 'Marzo 2022',
            'bundle' => null,
            'thinkific_id' => 1773341,
            'available_at' => Carbon::create('2022', '03', '05', '00', '00', '00', 'America/Bogota'),
        ]);

        CourseLife::create([
            'thinkific_id' => 1773341,
            'immediate' => true,
            'activation' => Carbon::now(),
            'duration' => 151,
        ]);
    }
}

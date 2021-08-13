<?php

use Illuminate\Database\Seeder;

class SchoolBundleCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Course::create([
            'name' => 'LVR School',
            'tagline' => 'School - Programa Completo',
            'description' => 'Este es el programa central de nuestra escuela de formación, en él enseñamos todos los temas fundamentales de la fe con un enfoque de gracia que de manera transversal está presente en todo el contenido. Este programa es la ruta indicada para aprender e interiorizar el ADN de Living Room.',
            'price' => 500000,
            'price_usd' => 145,
            'discount_percentage' => 20,
            'cohort' => 'Septiembre 2021',
            'bundle' => [884089, 884124, 884148],
            'available_at' => \Carbon\Carbon::create('2021', '08', '30', '00', '00', '00', 'America/Bogota'),
        ]);
    }
}

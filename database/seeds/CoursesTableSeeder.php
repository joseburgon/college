<?php

use App\Models\Course;
use Carbon\Carbon;
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
            'tagline' => 'School - Curso Básico',
            'description' => 'Este es el curso central de nuestro programa educativo y lo puedes realizar en modalidad virtual desde cualquier lugar del mundo. Tiene como propósito que puedas comprender más claramente cómo somos reconciliados con Dios por medio de su gracia.',
            'price' => 160000,
            'price_usd' => 45,
            'cohort' => 'Septiembre 2020',
            'thinkific_id' => 884089,
            'available_at' => Carbon::create('2020', '09', '30', '00', '00', '00', 'America/Bogota'),
        ]);

        Course::create([
            'name' => 'Curso de Finanzas',
            'tagline' => 'De la carencia a la abundancia',
            'description' => '¿Has escuchado esa frase que dice “el dinero llama al dinero”?, es una gran verdad,  la riqueza interior llama a la riqueza material porque atraemos lo que somos. Tu y yo fuimos diseñados para florecer y prosperar en todas las áreas de nuestra vida por eso hay semillas de grandeza en nuestro interior.',
            'price' => 140000,
            'price_usd' => 40,
            'cohort' => 'Agosto 2020',
            'thinkific_id' => 866807,
            'available_at' => Carbon::create('2020', '08', '31', '00', '00', '00', 'America/Bogota'),
        ]);

        Course::create([
            'name' => 'Autoridad Espiritual',
            'tagline' => 'Curso especializado de autoriad espiritual',
            'description' => 'Jesús, cuando estaba enviando a sus discípulos a vivir y compartir la vida sobrenatural y la victoria definitiva que el ganó para nosotros les dijo: Toda autoridad me ha sido dada en el cielo y en la tierra. Y ahí, dejando claro eso, los envió. Ahora, todos los creyentes comprendemos y vivimos esa autoridad? Vivimos la victoria completa que hemos heredado en todas las áreas de nuestra vida? En este curso estudiaremos principios espirituales que permitan que Dios lleve tu vida al nivel espiritual en el que puedas vivir el propósito que Él tiene para ti ejerciendo la autoridad espiritual que nos ha sido dada como herencia por nuestra fe en Jesús.',
            'price' => 140000,
            'price_usd' => 40,
            'cohort' => 'Octubre 2020',
            'thinkific_id' => 874120,
            'available_at' => Carbon::create('2020', '09', '30', '00', '00', '00', 'America/Bogota'),
        ]);

        Course::create([
            'name' => 'Curso Complementario',
            'tagline' => 'School - Curso Complementario',
            'description' => 'Este es el último nivel de School, continuaremos profundizando en el llamado de Dios y la autoridad delegada a los creyentes para llevar a cabo su obra a través de la Iglesia en una clase que hemos llamado: El cielo en la tierra. Haremos un recorrido histórico de la Iglesia y sus diferentes manifestaciones a lo largo del tiempo. Terminaremos revisando que opinan otras religiones acerca de Jesús y en qué se diferencian del Cristianismo.',
            'price' => 170000,
            'price_usd' => 50,
            'cohort' => 'Junio 2021',
            'thinkific_id' => 884148,
            'available_at' => Carbon::create('2021', '06', '09', '00', '00', '00', 'America/Bogota'),
        ]);

        Course::create([
            'name' => 'Connection',
            'tagline' => 'CONNECTION - Aprende a escuchar la voz de Dios',
            'description' => 'Curso presencial en Barranquilla, Medellín y Bucaramanga. Este curso se estará llevando a cabo de manera presencial en los siguientes campus: Barranquilla: 28, 29 y 30 de Julio de 7:00 pm a 10:00 pm. Medellín: 2, 3 y 4 de Agosto de 7:00 pm a 10:00 pm. Bucaramanga: 5, 6 de Agosto de 7:00 pm a 10:00 pm y 7 de Agosto de 10:30 am a 1:00 pm',
            'price' => 270000,
            'price_usd' => 70,
            'cohort' => 'Junio 2021',
            'thinkific_id' => 1408949,
            'available_at' => Carbon::create('2021', '06', '18', '00', '00', '00', 'America/Bogota'),
        ]);
    }
}

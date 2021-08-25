<?php

use Illuminate\Database\Seeder;

class TestCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Course::create([
            'name' => 'Test Course',
            'tagline' => 'Testing Product',
            'description' => 'This is just a fake course for testing purposes.',
            'price' => 5000,
            'price_usd' => 2,
            'discount_percentage' => 50,
            'cohort' => 'Septiembre 2021',
            'thinkific_id' => 761932,
            'available_at' => \Carbon\Carbon::create('2021', '08', '25', '00', '00', '00', 'America/Bogota'),
        ]);
    }
}

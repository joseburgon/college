<?php

use Illuminate\Database\Seeder;

class TestCourseLifeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* TEST COURSE */
        \App\Models\CourseLife::create([
            'thinkific_id' => 761932,
            'immediate' => true,
            'activation' => \Carbon\Carbon::now(),
            'duration' => 90,
        ]);
    }
}

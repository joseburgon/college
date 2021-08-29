<?php

use Illuminate\Database\Seeder;

class UpdateCoursesLifeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = \App\Models\Course::all();

        $courses->each(function($course) {
            if ($course->thinkific_id) {
                \App\Models\CourseLife::thinkific($course->thinkific_id)->update([
                    'course_id' => $course,
                ]);
            }
        });
    }
}

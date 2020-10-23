<?php

namespace App\Listeners;

use App\Models\Course;
use App\Models\Student;
use App\Repositories\ThinkificApi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateStudentsEnrollments implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Student::chunk(50, function ($students) {

            $apiRepo = new ThinkificApi();

            foreach ($students as $student) {

                $enrollments = $apiRepo->getStudentEnrollments($student->email);

                if (count($enrollments) > 0) {

                    $student->status = 'enrolled';

                    $thinkificCourses = [];

                    foreach ($enrollments as $enrollment) {

                        array_push($thinkificCourses, $enrollment['course_id']);
                    }

                    $coursesIds = Course::whereIn('thinkific_id', $thinkificCourses)->pluck('id');

                    $student->courses()->sync($coursesIds);

                } else {

                    $student->courses()->detach();

                }

            }

        });

        Log::info('Enrollments Updated!');
    }
}

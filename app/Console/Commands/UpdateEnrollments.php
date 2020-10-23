<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Course;
use App\Models\Student;
use App\Repositories\ThinkificApi;
use Illuminate\Support\Facades\Log;

class UpdateEnrollments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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

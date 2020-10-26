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
    protected $signature = 'enrollments:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating students enrollments';

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
        Student::whereDate('created_at', '>', '2020-10-20')->chunk(100, function ($students) {

            $apiRepo = new ThinkificApi();

            foreach ($students as $student) {

                $enrollments = $apiRepo->getStudentEnrollments($student->email);

                if (count($enrollments) > 0) {

                    $student->status = 'enrolled';

                    $courses = $this->getCourses($enrollments);

                    $student->courses()->sync($courses);

                } else {

                    $student->courses()->detach();

                }
            }

            sleep(60);

        });

        Log::info('Enrollments Updated!');
    }

    private function getCourses($enrollments)
    {
        $thinkificCourses = [];

        foreach ($enrollments as $enrollment) {

            array_push($thinkificCourses, $enrollment['course_id']);
        }

        return Course::whereIn('thinkific_id', $thinkificCourses)->pluck('id');

    }
}

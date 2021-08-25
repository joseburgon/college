<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Student;
use App\ExternalApis\ThinkificApi;
use App\Traits\Thinkific;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateEnrollments extends Command
{
    use Thinkific;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enrollments:create {course}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating masive enrollments for students with imported status';

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
        Student::where('status', 'imported')->chunk(50, function ($students) {

            foreach ($students as $student) {

                $this->info('Enrolling student: ' . $student->email);

                $user = $this->userCreationProcess($student);

                Log::info('Thinkific user created with ID: ' . $user['id']);

                $student->update([
                    'thinkific_user_id' => $user['id'],
                    'status' => 'user created'
                ]);

                $course = Course::find($this->argument('course'));

                $this->enroll($user['id'], $course->thinkific_id);

                $this->info('Student: ' . $student->email . ' enrolled.');

                $student->courses()->attach($course->id);

                $student->update(['status' => 'enrolled']);

            }

        });
    }
}

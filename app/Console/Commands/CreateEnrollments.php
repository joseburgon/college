<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Student;
use App\Repositories\ThinkificApi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateEnrollments extends Command
{
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

                $user = $this->userCreationProccess($student);

                Log::info('Thinkific user created with ID: ' . $user['id']);

                $student->fill([
                    'thinkific_user_id' => $user['id'],
                    'status' => 'user created'
                ])->save();

                $course = Course::find($this->argument('course'));

                $this->enrollmentProccess($user, $course, $student);

                $this->info('Student: ' . $student->email . ' enrolled.');

            }

        });
    }

    private function userCreationProccess($student)
    {
        $apiRepo = new ThinkificApi();

        $userExists = $apiRepo->checkIfUserExists($student->email);

        Log::info('User exists?', ['result' => $userExists]);

        if ($userExists) {

            Log: info('User already exists');

            $user = $apiRepo->getUser($student->email);

            return $user;
        }

        $password = 'College*2020';

        $userData = [
            'email' => $student->email,
            'first_name' => $student->name,
            'last_name' => $student->last_name,
            'password' => $password,
            'send_welcome_email' => false
        ];

        $user = $apiRepo->createUser($userData);

        return $user;
    }

    private function enrollmentProccess($user, $course, $student)
    {
        $apiRepo = new ThinkificApi();

        $enrollmentData = [
            'course_id' => $course->thinkific_id,
            'user_id' => $user['id'],
            'activated_at' => Carbon::now()->toISOString(),
        ];

        $enrollment = $apiRepo->createEnrollment($enrollmentData);

        Log::info('Student enrolled successfully in course.', $enrollment);

        $student->courses()->attach($course->id);

        $student->fill(['status' => 'enrolled'])->save();

    }
}

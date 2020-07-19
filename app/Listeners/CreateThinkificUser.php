<?php

namespace App\Listeners;

use App\Events\TransactionSaved;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\ThinkificApi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CreateThinkificUser implements ShouldQueue
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
     * @param  TransactionSaved  $event
     * @return void
     */
    public function handle(TransactionSaved $event)
    {
        $transaction = $event->transaction;

        if (intval($transaction->state_pol) === 4) {

            Log::info('Transaction approved!', (array) $transaction);

            $student = Student::where('email', $transaction->email_buyer)->first();

            Log::info('Retrieving student', (array) $student);

            $user = $this->userCreationProccess($student);

            Log::info('Thinkific user created with ID: ' . $user['id']);

            $student->fill([
                'thinkific_user_id' => $user['id'],
                'status' => 'user created'
            ])->save();

            $course = Course::find($transaction->extra2);

            $enrollment = $this->enrollmentProccess($user, $course, $student);
            
        } else {

            Log::info('Transaction not approved', (array) $transaction);
        }
    }

    private function userCreationProccess($student)
    {

        $apiRepo = new ThinkificApi();

        $userExists = $apiRepo->checkIfUserExists($student->email);

        if ($userExists) {

            $user = $apiRepo->getUser($student->email);

            return $user;
        }

        $password = Str::random(8);

        $userData = [
            'email' => $student->email,
            'first_name' => $student->name,
            'last_name' => $student->last_name,
            'password' => $password,
            'roles' => ["affiliate"],
            'affiliate_commission' => 0,
            'affiliate_payout_email' => $student->email,
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
            'activated_at' => now(),
        ];

        $enrollment = $apiRepo->createEnrollment($enrollmentData);

        Log::info('Student enrolled successfully in course ' . $enrollment['course_name']);

        $student->fill(['status' => 'enrolled'])->save();
    }
}

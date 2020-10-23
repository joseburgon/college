<?php

namespace App\Listeners;

use App\Events\TransactionSaved;
use App\Mail\ThinkificCredentials;
use App\Models\ReferenceCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\ThinkificApi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        Log::info('Llegue al listener');

        $status = $transaction->status;

        if ($status === 'approved' || $status === 'COMPLETED') {

            Log::info('Transaction approved!', (array) $transaction);

            $referenceCode = ReferenceCode::find($transaction->external_reference);

            Log::info('Getting reference!', (array) $referenceCode);

            $student = $referenceCode->student;

            Log::info('Retrieving student', (array) $student);

            $user = $this->userCreationProccess($student);

            Log::info('Thinkific user created with ID: ' . $user['id']);

            $student->fill([
                'thinkific_user_id' => $user['id'],
                'status' => 'user created'
            ])->save();

            $course = $referenceCode->course;

            $this->enrollmentProccess($user, $course, $student);

        } else {

            Log::info('Transaction not approved', (array) $transaction);

        }
    }

    private function userCreationProccess($student)
    {

        $apiRepo = new ThinkificApi();

        $userExists = $apiRepo->checkIfUserExists($student->email);

        Log::info('User exists?', ['result' => $userExists]);

        if ($userExists) {

            Log: info('User already exists');

            $user = $apiRepo->getUser($student->email);

            //Mail::to($student->email)->queue(new ThinkificCredentials($user));

            return $user;
        }

        //$password = Str::random(8);
        $password = 'College*2020';

        $userData = [
            'email' => $student->email,
            'first_name' => $student->name,
            'last_name' => $student->last_name,
            'password' => $password,
            'send_welcome_email' => false
        ];

        $user = $apiRepo->createUser($userData);

        //Mail::to($student->email)->queue(new ThinkificCredentials($userData));

        return $user;
    }

    private function enrollmentProccess($user, $course, $student)
    {
        $apiRepo = new ThinkificApi();

        $enrollmentData = [
            'course_id' => $course->thinkific_id,
            'user_id' => $user['id'],
            'activated_at' => $course->available_at,
        ];

        $enrollment = $apiRepo->createEnrollment($enrollmentData);

        Log::info('Student enrolled successfully in course.', $enrollment);

        $student->courses()->attach($course->id);

        $student->fill(['status' => 'enrolled'])->save();

    }
}

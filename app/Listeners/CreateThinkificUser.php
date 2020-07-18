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

class CreateThinkificUser
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

            $student = Student::where('identification', $transaction->extra1);

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

            $apiRepo = new ThinkificApi();

            $user = $apiRepo->createUser($userData);

            if ($user->successful()) {

                Log::info('Thinkific user created with ID: ' . $user->id);

                $student->update([
                    'thinkific_user_id' => $user->id,
                    'status' => 'user created'
                ]);

                $course = Course::find($transaction->extra2);

                $enrollmentData = [
                    'course_id' => $course->thinkific_id,
                    'user_id' => $user->id,
                    'activated_at' => now(),
                ];

                $enrollment = $apiRepo->createEnrollment($enrollmentData);

                if ($enrollment->successful()) {

                    Log::info('Studente enrolled successfully in course ' . $enrollment->course_name);

                    $student->update(['status' => 'enrolled']);

                }
            }

        } else {

            Log::info('Transaction not approved', (array) $transaction);
        }
    }
}

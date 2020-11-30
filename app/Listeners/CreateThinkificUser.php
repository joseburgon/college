<?php

namespace App\Listeners;

use App\Events\TransactionSaved;
use App\Models\ReferenceCode;
use App\Traits\Thinkific;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class CreateThinkificUser implements ShouldQueue
{
    use Thinkific;

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

        Log::info('Llegué al listener');

        $status = $transaction->status;

        if ($status === 'approved' || $status === 'COMPLETED') {

            Log::info('Transaction approved!', (array) $transaction);

            $referenceCode = ReferenceCode::find($transaction->external_reference);

            Log::info('Getting reference!', (array) $referenceCode);

            $student = $referenceCode->student;

            Log::info('Retrieving student', (array) $student);

            $user = $this->userCreationProcess($student);

            Log::info('Thinkific user created with ID: ' . $user['id']);

            $student->fill([
                'thinkific_user_id' => $user['id'],
                'status' => 'user created'
            ])->save();

            $course = $referenceCode->course;

            $this->enrollmentProcess($user, $course, $student);

        } else {

            Log::info('Transaction not approved', (array) $transaction);

        }
    }
}

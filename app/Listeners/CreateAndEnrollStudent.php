<?php

namespace App\Listeners;

use App\Events\FinanceCoursePurchased;
use App\Traits\Thinkific;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreateAndEnrollStudent implements ShouldQueue
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
     * @param  FinanceCoursePurchased  $event
     * @return void
     */
    public function handle(FinanceCoursePurchased $event)
    {
        Log::info('Llegué al listener: CreateAndEnrollStudent');

        $student = $event->student;

        $user = $this->userCreationProcess($student);

        Log::info('Thinkific user created with ID: ' . $user['id']);

        $student->fill([
            'thinkific_user_id' => $user['id'],
            'status' => 'user created'
        ])->save();

        $course = $event->course;

        $this->enrollmentProcess($user, $course, $student);
    }
}

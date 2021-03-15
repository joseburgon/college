<?php

namespace App\Events;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FinanceCoursePurchased
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $student;
    public $course;

    /**
     * Create a new event instance.
     *
     * @param Student $student
     */
    public function __construct(Student $student)
    {
        $this->student = $student;

        $this->course = Course::find(2);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

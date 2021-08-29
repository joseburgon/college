<?php

namespace App\Traits;

use App\ExternalApis\ThinkificApi;
use App\Models\Course;
use App\Models\CourseLife;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait Thinkific
{
    function userCreationProcess(Student $student)
    {
        $userExists = ThinkificApi::checkIfUserExists($student->email);

        Log::info('User exists?', ['result' => $userExists]);

        if ($userExists) {

            Log::info('User already exists');

            $user = ThinkificApi::getUser($student->email);

            return $user;
        }

        $password = 'College*2021';

        $userData = [
            'email' => $student->email,
            'first_name' => $student->name,
            'last_name' => $student->last_name,
            'password' => $password,
            'send_welcome_email' => false
        ];

        $user = ThinkificApi::createUser($userData);

        return $user;

    }

    function enroll($userId, Course $course)
    {
        $life = CourseLife::course($course->id)
            ->thinkific($course->thinkific_id)
            ->first();

        $activatedAtDate = $life->activation;

        if ($life->immediate) {
            $activatedAtDate = Carbon::now();
        }

        $expiryDate = $activatedAtDate->addDays($life->duration);

        $enrollmentData = [
            'course_id' => $life->thinkific_id,
            'user_id' => $userId,
            'activated_at' => $activatedAtDate->toJSON(),
            'expiry_date' => $expiryDate->toJSON(),
        ];

        $enrollment = ThinkificApi::createEnrollment($enrollmentData);

        Log::info('Student enrolled successfully in course.', $enrollment);
    }
}


<?php

namespace App\Traits;

use App\ExternalApis\ThinkificApi;
use App\Models\Course;
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

            Log:
            info('User already exists');

            $user = ThinkificApi::getUser($student->email);

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

        $user = ThinkificApi::createUser($userData);

        return $user;

    }

    function enrollmentProcess($user, Course $course, Student $student)
    {
        $activatedAtDate = Carbon::now();

        $expiryDate = $activatedAtDate->addWeeks(10);

        $enrollmentData = [
            'course_id' => $course->thinkific_id,
            'user_id' => $user['id'],
            'activated_at' => $activatedAtDate->toJSON(),
            'expiry_date' => $expiryDate->toJSON(),
        ];

        $enrollment = ThinkificApi::createEnrollment($enrollmentData);

        Log::info('Student enrolled successfully in course.', $enrollment);

        $student->courses()->attach($course->id);

        $student->fill(['status' => 'enrolled'])->save();
    }
}


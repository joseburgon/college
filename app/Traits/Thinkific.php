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

        $apiRepo = new ThinkificApi();

        $userExists = $apiRepo->checkIfUserExists($student->email);

        Log::info('User exists?', ['result' => $userExists]);

        if ($userExists) {

            Log:
            info('User already exists');

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

    function enrollmentProcess($user, Course $course, Student $student)
    {

        $apiRepo = new ThinkificApi();

        $activatedAtDate = Carbon::now();

        $expiryDate = $activatedAtDate->addDays(60);

        $enrollmentData = [
            'course_id' => $course->thinkific_id,
            'user_id' => $user['id'],
            'activated_at' => $activatedAtDate->toISOString(),
            'expiry_date' => $expiryDate->toISOString(),
        ];

        $enrollment = $apiRepo->createEnrollment($enrollmentData);

        Log::info('Student enrolled successfully in course.', $enrollment);

        $student->courses()->attach($course->id);

        $student->fill(['status' => 'enrolled'])->save();

    }
}


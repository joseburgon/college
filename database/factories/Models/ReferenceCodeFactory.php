<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use App\Models\ReferenceCode;
use App\Models\Student;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ReferenceCode::class, function (Faker $faker) {
    return [
        'code' => (string) Str::uuid(),
        'course_id' => factory(Course::class),
        'student_id' => factory(Student::class),
    ];
});

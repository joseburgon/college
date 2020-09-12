<?php

namespace Tests\Feature\Students;

use App\Models\Student;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ListStudentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_single_student()
    {
        $student = factory(Student::class)->create();

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get(route('api.v1.students.read', $student))->assertSee($student->name);
    }

    /** @test */
    public function can_fetch_all_students()
    {
        $students = factory(Student::class)->times(3)->create();

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get(route('api.v1.students.index'))->assertSee($students[0]->name);
    }
}

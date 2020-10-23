<?php

namespace Tests\Feature\Students;

use App\Models\Student;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateStudentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_users_cannot_update_students()
    {
        $student = factory(Student::class)->create();

        $this->jsonApi()->patch(route('api.v1.students.update', $student))
            ->assertStatus(401);
    }

    /** @test */
    public function authenticated_users_can_update_students()
    {
        $student = factory(Student::class)->create();

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()
            ->content([
                'data' => [
                    'type' => 'students',
                    'id' => (string) $student->getRouteKey(),
                    'attributes' => [
                        'identification' => '90060074',
                        'phone' => '3114258974',
                        'city' => 'City changed'
                    ]
                ]
            ])
            ->patch(route('api.v1.students.update', $student))
            ->assertStatus(200);

        $this->assertDatabaseHas('students', [
            'identification' => '90060074',
            'phone' => '3114258974',
            'city' => 'City changed'
        ]);
    }

    /** @test */
    public function update_students_enrollments()
    {
        $student = factory(Student::class)->times(10)->create();

        $this->jsonApi()->patch(route('api.v1.students.update', $student))
            ->assertStatus(401);
    }
}

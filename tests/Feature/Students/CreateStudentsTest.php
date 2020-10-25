<?php

namespace Tests\Feature\Students;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateStudentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_students()
    {
        $student = [
            'name' => 'Juancho',
            'last_name' => 'Polo',
            'identification' => '90030050',
            'phone' => '3157890665',
            'email' => 'juancho@mail.com',
            'city' => 'Cali',
            'state' => 'Valle del Cauca',
            'country' => 'Colombia',
            'status' => 'enrolled',
            'thinkific_user_id' => '28119489'
        ];

        Sanctum::actingAs(factory(User::class)->create());

        $this->assertDatabaseMissing('students', $student);

        $this->jsonApi()->content([
            'data' => [
                'type' => 'students',
                'attributes' => $student
            ]
        ])->post(route('api.v1.students.create'))->assertCreated();

        $this->assertDatabaseHas('students', $student);
    }
}

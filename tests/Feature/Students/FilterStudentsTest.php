<?php

namespace Tests\Feature\Students;

use App\Models\Student;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FilterStudentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_filter_students_by_name_email_and_identification()
    {
        factory(Student::class)->create([
            'name' => 'Ricardo',
            'last_name' => 'Ordoñez',
            'email' => 'richard12@mail.com',
            'identification' => '90060025'
        ]);

        factory(Student::class)->create([
            'name' => 'Ronnie',
            'last_name' => 'Perez',
            'email' => 'richard_perez@mail.com',
            'identification' => '90060080'
        ]);

        factory(Student::class)->create([
            'name' => 'Jorge',
            'last_name' => 'Alvarez',
            'email' => 'jorge@mail.com',
            'identification' => '1140856932'
        ]);

        $url = route('api.v1.students.index', ['filter[search]' => '900600']);

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get($url)
            ->assertJsonCount(2, 'data')
            ->assertSee('Ricardo')
            ->assertSee('Ronnie')
            ->assertDontSee('Jorge');
    }

    /** @test */
    public function can_filter_students_by_multiple_terms()
    {
        factory(Student::class)->create([
            'name' => 'Ricardo',
            'last_name' => 'Ordoñez',
            'email' => 'richard12@mail.com',
            'identification' => '90060025'
        ]);

        factory(Student::class)->create([
            'name' => 'Ronnie',
            'last_name' => 'Perez',
            'email' => 'richard_perez@mail.com',
            'identification' => '90060080'
        ]);

        factory(Student::class)->create([
            'name' => 'Jorge',
            'last_name' => 'Alvarez',
            'email' => 'jorge@mail.com',
            'identification' => '1140856932'
        ]);

        factory(Student::class)->create([
            'name' => 'Maria Fernanda',
            'last_name' => 'Urrieta',
            'email' => 'mafeurrieta@mail.com',
            'identification' => '50087421'
        ]);

        $url = route('api.v1.students.index', ['filter[search]' => '50087421 richard']);

        //dd(urldecode($url));

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get($url)
            ->assertJsonCount(3, 'data')
            ->assertSee('Ricardo')
            ->assertSee('Ronnie')
            ->assertSee('Urrieta')
            ->assertDontSee('Jorge');
    }
}

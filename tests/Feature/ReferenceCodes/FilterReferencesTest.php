<?php

namespace Tests\Feature\ReferenceCodes;

use App\Models\ReferenceCode;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FilterReferencesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_filter_references_by_id_and_code_with_multiple_terms()
    {
        factory(ReferenceCode::class)->create([
            'id' => 54,
            'code' => '730-aq54'
        ]);

        factory(ReferenceCode::class)->create([
            'id' => 700,
            'code' => '620-pu00'
        ]);

        factory(ReferenceCode::class)->create([
            'id' => 887,
            'code' => '620-qw75'
        ]);

        factory(ReferenceCode::class)->create([
            'id' => 100,
            'code' => '500-aa69'
        ]);

        $url = route('api.v1.reference-codes.index', ['filter[search]' => '54 620']);

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get($url)
            ->assertJsonCount(3, 'data')
            ->assertSee(54)
            ->assertSee('620')
            ->assertSee('620')
            ->assertDontSee(100);
    }
}

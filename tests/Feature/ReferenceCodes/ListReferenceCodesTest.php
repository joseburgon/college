<?php

namespace Tests\Feature\ReferenceCodes;

use App\Models\ReferenceCode;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ListReferenceCodesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_single_reference_codes()
    {
        $referenceCode = factory(ReferenceCode::class)->create();

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()
            ->get(route('api.v1.reference-codes.read', $referenceCode))
            ->assertSee($referenceCode->code);
    }

    /** @test */
    public function can_fetch_all_reference_codes()
    {
        $referenceCodes = factory(ReferenceCode::class)->times(3)->create();

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get(route('api.v1.reference-codes.index'))->assertSee($referenceCodes[0]->code);
    }
}

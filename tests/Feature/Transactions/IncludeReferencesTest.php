<?php

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IncludeReferencesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_include_references()
    {
        $transaction = factory(Transaction::class)->create();

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()
            ->includePaths('referenceCode')
            ->get(route('api.v1.transactions.read', $transaction))->dump()
            ->assertSee($transaction->referenceCode->code);


    }
}

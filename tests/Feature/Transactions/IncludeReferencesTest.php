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
            ->includePaths('reference-codes')
            ->get(route('api.v1.transactions.read', $transaction))
            ->assertSee($transaction->referenceCode->code)
            ->assertJsonFragment([
                'related' => route('api.v1.transactions.relationships.reference-codes', $transaction)
            ])
            ->assertJsonFragment([
                'self' => route('api.v1.transactions.relationships.reference-codes.read', $transaction)
            ]);
    }

    /** @test */
    public function can_fetch_related_references()
    {
        $transaction = factory(Transaction::class)->create();

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()
            ->get(route('api.v1.transactions.relationships.reference-codes', $transaction))
            ->assertSee($transaction->referenceCode->code);

        $this->jsonApi()
            ->get(route('api.v1.transactions.relationships.reference-codes.read', $transaction))
            ->assertSee($transaction->referenceCode->id);
    }
}

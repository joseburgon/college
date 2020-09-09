<?php

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateTransactionsTest extends TestCase
{
    use RefreshDatabase;

    public function guests_users_cannot_update_articles()
    {
        $transaction = factory(Transaction::class)->create();

        //Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->patch(route('api.v1.transactions.update', $transaction))
            ->assertStatus(401);
    }

    /** @test */
    public function authenticated_users_can_update_articles()
    {
        $transaction = factory(Transaction::class)->create();

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->content([
            'data' => [
                'type' => 'transactions',
                'id' => (string) $transaction->getRouteKey(),
                'attributes' => [
                    'status' => 'pending',
                    'payment_method_id' => 'pse',
                    'description' => 'Description changed'
                ]
            ]
        ])
            ->patch(route('api.v1.transactions.update', $transaction))
            ->assertStatus(200);

        $this->assertDatabaseHas('transactions', [
            'status' => 'pending',
            'payment_method_id' => 'pse',
            'description' => 'Description changed'
        ]);
    }
}

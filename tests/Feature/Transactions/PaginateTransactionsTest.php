<?php

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PaginateTransactionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_paginated_transactions()
    {
        $this->withoutExceptionHandling();

        Sanctum::actingAs(factory(User::class)->create());

        $transactions = factory(Transaction::class)->times(10)->create();

        $url = route('api.v1.transactions.index', ['page[number]' => 3, 'page[size]' => 2]);

        $this->jsonApi()->get($url)
            ->assertJsonCount(2, 'data')
            ->assertDontSee($transactions[0]->description)
            ->assertDontSee($transactions[1]->description)
            ->assertDontSee($transactions[2]->description)
            ->assertDontSee($transactions[3]->description)
            ->assertSee($transactions[4]->description)
            ->assertSee($transactions[5]->description)
            ->assertDontSee($transactions[6]->description)
            ->assertDontSee($transactions[7]->description)
            ->assertDontSee($transactions[8]->description)
            ->assertDontSee($transactions[9]->description)
            ->assertJsonStructure([
                'links' => ['first', 'last', 'prev', 'next']
            ])
            ->assertJsonFragment([
                'first' => route('api.v1.transactions.index', ['page[number]' => 1, 'page[size]' => 2]),
                'last' => route('api.v1.transactions.index', ['page[number]' => 5, 'page[size]' => 2]),
                'prev' => route('api.v1.transactions.index', ['page[number]' => 2, 'page[size]' => 2]),
                'next' => route('api.v1.transactions.index', ['page[number]' => 4, 'page[size]' => 2]),
            ]);
    }
}

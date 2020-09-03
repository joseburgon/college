<?php

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaginateTransactionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_paginated_transactions()
    {
        $this->withoutExceptionHandling();

        $transactions = factory(Transaction::class)->times(10)->create();

        $url = route('api.v1.transactions.index', ['page[number]' => 3, 'page[size]' => 2]);

        $response = $this->jsonApi()->get($url);

        $response->assertJsonCount(2, 'data')
            ->assertDontSee($transactions[0]->external_reference)
            ->assertDontSee($transactions[1]->external_reference)
            ->assertDontSee($transactions[2]->external_reference)
            ->assertDontSee($transactions[3]->external_reference)
            ->assertSee($transactions[4]->external_reference)
            ->assertSee($transactions[5]->external_reference)
            ->assertDontSee($transactions[6]->external_reference)
            ->assertDontSee($transactions[7]->external_reference)
            ->assertDontSee($transactions[8]->external_reference)
            ->assertDontSee($transactions[9]->external_reference);

        $response->assertJsonStructure([
            'links' => ['first', 'last', 'prev', 'next']
        ]);

        $response->assertJsonFragment([
            'first' => route('api.v1.transactions.index', ['page[number]' => 1, 'page[size]' => 2]),
            'last' => route('api.v1.transactions.index', ['page[number]' => 5, 'page[size]' => 2]),
            'prev' => route('api.v1.transactions.index', ['page[number]' => 2, 'page[size]' => 2]),
            'next' => route('api.v1.transactions.index', ['page[number]' => 4, 'page[size]' => 2]),
        ]);
    }
}

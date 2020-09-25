<?php

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FilterTransactionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_filter_transactions_by_id()
    {
        factory(Transaction::class)->create([
            'id' => 9110
        ]);

        factory(Transaction::class)->create([
            'id' => 9941
        ]);

        $url = route('api.v1.transactions.index', ['filter[id]' => 9110]);

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get($url)
            ->assertJsonCount(1, 'data')
            ->assertSee(9110)
            ->assertDontSee(9941);
    }

    /** @test */
    public function can_filter_transactions_by_status()
    {
        factory(Transaction::class)->create([
            'status' => 'approved'
        ]);

        factory(Transaction::class)->create([
            'status' => 'rejected'
        ]);

        $url = route('api.v1.transactions.index', ['filter[status]' => 'approved']);

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('approved')
            ->assertDontSee('rejected');
    }

    /** @test */
    public function can_filter_transactions_by_year()
    {
        factory(Transaction::class)->create([
            'status' => 'approved',
            'created_at' => now()->year(2020)
        ]);

        factory(Transaction::class)->create([
            'status' => 'rejected',
            'created_at' => now()->year(2021)
        ]);

        $url = route('api.v1.transactions.index', ['filter[year]' => 2020]);

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('approved')
            ->assertDontSee('rejected');
    }

    /** @test */
    public function can_filter_transactions_by_month()
    {
        factory(Transaction::class)->create([
            'status' => 'approved',
            'created_at' => now()->month(2)
        ]);

        factory(Transaction::class)->create([
            'status' => 'pending',
            'created_at' => now()->month(2)
        ]);

        factory(Transaction::class)->create([
            'status' => 'rejected',
            'created_at' => now()->month(1)
        ]);

        $url = route('api.v1.transactions.index', ['filter[month]' => 2]);

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get($url)
            ->assertJsonCount(2, 'data')
            ->assertSee('approved')
            ->assertSee('pending')
            ->assertDontSee('rejected');
    }

    /** @test */
    public function cant_filter_transactions_by_unknowm_filters()
    {
        factory(Transaction::class)->create();

        $url = route('api.v1.transactions.index', ['filter[unknown]' => 'random']);

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get($url)->assertStatus(400);
    }

    /** @test */
    public function can_filter_transactions_by_id_and_reference()
    {
        factory(Transaction::class)->create([
            'id' => 54,
            'external_reference' => 320
        ]);

        factory(Transaction::class)->create([
            'id' => 887,
            'external_reference' => 554
        ]);

        factory(Transaction::class)->create([
            'id' => 100,
            'external_reference' => 135
        ]);

        $url = route('api.v1.transactions.index', ['filter[search]' => '54']);

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get($url)
            ->assertJsonCount(2, 'data')
            ->assertSee(54)
            ->assertSee(554)
            ->assertDontSee(100);
    }

    /** @test */
    public function can_filter_transactions_by_id_and_reference_with_multiple_terms()
    {
        factory(Transaction::class)->create([
            'id' => 54,
            'external_reference' => 320
        ]);

        factory(Transaction::class)->create([
            'id' => 700,
            'external_reference' => 554
        ]);

        factory(Transaction::class)->create([
            'id' => 887,
            'external_reference' => 554
        ]);

        factory(Transaction::class)->create([
            'id' => 100,
            'external_reference' => 135
        ]);

        $url = route('api.v1.transactions.index', ['filter[search]' => '54 700']);

        Sanctum::actingAs(factory(User::class)->create());

        $this->jsonApi()->get($url)
            ->assertJsonCount(3, 'data')
            ->assertSee(54)
            ->assertSee(700)
            ->assertSee(554)
            ->assertDontSee(100);
    }
}

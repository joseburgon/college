<?php

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SortTransactionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_sort_transactions_by_status_asc()
    {
        factory(Transaction::class)->create(['status' => 'pending']);
        factory(Transaction::class)->create(['status' => 'approved']);
        factory(Transaction::class)->create(['status' => 'rejected']);

        $url = route('api.v1.transactions.index', ['sort' => 'status']);

        $this->jsonApi()->get($url)->assertSeeInOrder([
            'approved',
            'pending',
            'rejected'
        ]);
    }

    /** @test */
    public function it_can_sort_transactions_by_status_desc()
    {
        factory(Transaction::class)->create(['status' => 'pending']);
        factory(Transaction::class)->create(['status' => 'approved']);
        factory(Transaction::class)->create(['status' => 'rejected']);

        $url = route('api.v1.transactions.index', ['sort' => '-status']);

        $this->jsonApi()->get($url)->assertSeeInOrder([
            'rejected',
            'pending',
            'approved',
        ]);
    }

    /** @test */
    public function it_can_sort_transactions_by_status_and_reference()
    {
        factory(Transaction::class)->create([
            'status' => 'pending',
            'external_reference' => 20
        ]);
        factory(Transaction::class)->create([
            'status' => 'approved',
            'external_reference' => 25
        ]);
        factory(Transaction::class)->create([
            'status' => 'rejected',
            'external_reference' => 30
        ]);

        $url = route('api.v1.transactions.index') . '?sort=status,-external_reference';

        $this->jsonApi()->get($url)->assertSeeInOrder([
            'approved',
            'pending',
            'rejected',
        ]);

        $url = route('api.v1.transactions.index') . '?sort=-external_reference,status';

        $this->jsonApi()->get($url)->assertSeeInOrder([
            'rejected',
            'approved',
            'pending',
        ]);
    }

    /** @test */
    public function it_cannot_sort_transactions_by_unknown_field()
    {
        factory(Transaction::class)->times(3)->create();

        $url = route('api.v1.transactions.index') . '?sort=unknown';

        $this->jsonApi()->get($url)->assertStatus(400);
    }
}

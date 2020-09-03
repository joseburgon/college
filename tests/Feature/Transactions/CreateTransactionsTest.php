<?php

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Tests\TestCase;

class CreateTransactionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_transactions()
    {
        $transaction = [
            'payment-type' => Arr::random(['MERCADOPAGO', 'PAYPAL']),
            'status_detail' => 'accredited',
            'payment_method_id' => Arr::random(['pse', 'amex', 'ticket']),
            'status' => Arr::random(['approved', 'rejected', 'pending']),
            'external_reference' => Str::random(8),
        ];

        $this->assertDatabaseMissing('transactions', $transaction);

        $this->jsonApi()->content([
            'data' => [
                'type' => 'transactions',
                'attributes' => $transaction
            ]
        ])->post(route('api.v1.transactions.create'))->assertCreated();

        //$this->assertDatabaseHas('transactions', $transaction);
    }

    /** @test */
    public function status_is_required()
    {
        $transaction = [
            'payment-type' => Arr::random(['MERCADOPAGO', 'PAYPAL']),
            'status_detail' => 'accredited',
            'payment_method_id' => Arr::random(['pse', 'amex', 'ticket']),
            'status' => '',
            'external_reference' => Str::random(8),
        ];

        $this->jsonApi()->content([
            'data' => [
                'type' => 'transactions',
                'attributes' => $transaction
            ]
        ])->post(route('api.v1.transactions.create'))
            ->assertStatus(422)
            ->assertSee('data\/attributes\/status');

        $this->assertDatabaseMissing('transactions', $transaction);
    }
}

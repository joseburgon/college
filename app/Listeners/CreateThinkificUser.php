<?php

namespace App\Listeners;

use App\Events\TransactionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreateThinkificUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TransactionSaved  $event
     * @return void
     */
    public function handle(TransactionSaved $event)
    {
        $transaction = $event->transaction;

        if (intval($transaction->state_pol) === 4) {

            Log::info('Transaction approved!', $transaction);

            $data = [
                'email' => $transaction->email_buyer,
                'first_name' => 'Test Name',
                'last_name' => 'Test LastName',
                'password' => '12345678',
                'roles' => ["affiliate"],
                'affiliate_commission' => 0,
                'affiliate_payout_email' => 'test3@email.com',
            ];

        } else {

            Log::info('Transaction not approved', $transaction);

        }
    }
}

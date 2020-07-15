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
        if ($event->transaction->state_pol === 4) {

            Log::info('Transaction approved!');

        } else {

            Log::info('Transaction not approved.');
            
        }
    }
}

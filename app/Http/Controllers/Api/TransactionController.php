<?php

namespace App\Http\Controllers\Api;

use App\Events\TransactionSaved;
use App\Http\Controllers\Controller;
use App\Repositories\MercadoPagoApi;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Request', $request->input());

        if (isset($request->type)) {
            if ($request->type === 'payment') {
                $apiRepo = new MercadoPagoApi();
                
                $id = $request->input('data_id');

                $payment = $apiRepo->getPayment($id);

                if ($payment['status'] === 'approved') {

                    $transaction = Transaction::firstOrCreate(
                        ['id' => $payment['id']],
                        $payment
                    );
        
                    Log::info('Transaction stored', $transaction);
                    
                    //TransactionSaved::dispatch($transaction);

                }
            }
        }
        
        return response()->json(
            ['message' => 'Received!'], 200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}

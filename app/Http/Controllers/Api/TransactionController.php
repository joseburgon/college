<?php

namespace App\Http\Controllers\Api;

use App\Events\TransactionSaved;
use App\Http\Controllers\Controller;
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

        $ApiKey = config('app.payu.apiKey');
        $merchantId = config('app.payu.merchantId');

        $referenceCode = $request->reference_sale;
        $txtValue = $request->value;
        $newValue = number_format($txtValue, 1, '.', '');
        $currency = $request->currency;
        $statePol = $request->state_pol;
        $sign = $request->sign;

        $signature = "$ApiKey~$merchantId~$referenceCode~$newValue~$currency~$statePol";
        $signatureMd5 = md5($signature);

        $responseMsg = 'Something went wrong';

        if ($signatureMd5 === $sign) {            
            
            $data = $request->all();

            $transaction = Transaction::create($data);

            Log::info('Transaction stored', $data);
            
            TransactionSaved::dispatch($transaction);

            $responseMsg = 'Transaction stored!';

        }       
        
        return response()->json([
            'message' => $responseMsg
        ]);
        
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

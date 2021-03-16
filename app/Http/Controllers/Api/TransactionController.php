<?php

namespace App\Http\Controllers\Api;

use App\Events\FinanceCoursePurchased;
use App\Events\TransactionSaved;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\TransactionResource;
use App\ExternalApis\MercadoPagoApi;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{

    public function index(Request $request)
    {
        $transactions = Transaction::applyFilters()->applySorts()->jsonPaginate();

        return TransactionCollection::make($transactions);
    }

    public function countApproved()
    {
        return Transaction::where('status', 'approved')->orWhere('status', 'COMPLETED')->count();
    }

    public function show(Transaction $transaction)
    {
        return TransactionResource::make($transaction);
    }

    public function mercadopago(Request $request)
    {
        Log::info('MercadoPago Notification Request', $request->input());

        if (isset($request->type)) {
            if ($request->type === 'payment') {

                $id = $request->data_id;

                $payment = MercadoPagoApi::getPayment($id);
                $payment['type'] = 'MERCADOPAGO';

                $transaction = Transaction::updateOrCreate(
                    ['id' => $payment['id']],
                    $payment
                );

                Log::info('Transaction stored', (array) $transaction);

                TransactionSaved::dispatch($transaction);
            }
        }

        return response()->json(
            ['message' => 'Received!'],
            200
        );
    }

    public function paypal(Request $request)
    {
        $data = $request->input();

        Log::info('PayPal Notification Request', $data);

        $transaction = Transaction::firstOrCreate(
            ['paypal_order' => $data['paypal_order']],
            $data
        );

        Log::info('Transaction stored', (array) $transaction);

        TransactionSaved::dispatch($transaction);
    }

    public function hotmart(Request $request)
    {
        $data = $request->input();

        Log::info('Hotmart data', (array) $data);

        if ($request->status == 'approved') {

            $student = Student::updateOrCreate(['email' => $request->email],
                [
                    'identification' => 'NO REGISTRA',
                    'name' => $request->first_name ?? 'Sin nombre en Checkout',
                    'last_name' => $request->last_name ?? 'Sin apellido en checkout',
                    'phone' => $request->phone_checkout_number ?? 'Sin telefono en checkout',
                    'city' => $request->address_city ?? 'Sin ciudad en checkout',
                    'state' => $request->address_state ?? 'Sin estado en checkout',
                    'country' => $request->address_country ?? 'Sin pais en checkout',
                ]
            );

            Log::info('Student created from Hotmart', (array) $student);

            FinanceCoursePurchased::dispatch($student);

        }

        return response()->json(
            ['message' => 'Received!'],
            200
        );

    }
}

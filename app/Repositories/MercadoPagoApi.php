<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MercadoPagoApi
{
    private $baseUrl = 'https://api.mercadopago.com/';

    private $token;

    public function __construct()
    {
        $this->token = env('MERCADOPAGO_ACCESS_TOKEN');
    }

    public function getPayment($id)
    {
        $response = Http::get($this->baseUrl . 'v1/payments/' . $id, 
            ['access_token' => $this->token])->throw();
        
        if ($response->successful()) {
            return $response->json();
        }        
    }

    public function getOrder($id)
    {
        $response = Http::get($this->baseUrl . 'merchant_orders/' . $id, 
            ['access_token' => $this->token])->throw();
        
        if ($response->successful()) {
            return $response->json();
        }        
    }
}
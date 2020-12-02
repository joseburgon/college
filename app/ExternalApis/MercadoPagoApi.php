<?php

namespace App\ExternalApis;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MercadoPagoApi
{
    private const BASE_URL = 'https://api.mercadopago.com/';

    private static $token;

    public static function __constructStatic()
    {
        static::$token = config('app.mercadopago_access_token');
    }

    public static function getPayment($id)
    {
        $response = Http::get(self::BASE_URL . 'v1/payments/' . $id,
            ['access_token' => self::$token])
            ->throw();

        return $response->json();
    }

    public static function getOrder($id)
    {
        $response = Http::get(self::BASE_URL . 'merchant_orders/' . $id,
            ['access_token' => self::$token])
            ->throw();

        return $response->json();
    }
}

MercadoPagoApi::__constructStatic();

<?php

use Illuminate\Support\Facades\Route;
use App\Repositories\MercadoPagoApi;

Auth::routes();

Route::get('testing', function () {
    $apiRepo = new MercadoPagoApi();
    return $apiRepo->getPayment('28692185');
});

Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->name('home');

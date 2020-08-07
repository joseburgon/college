<?php

use Illuminate\Support\Facades\Route;
use App\Repositories\MercadoPagoApi;

Auth::routes();

Route::get('testing', function () {
    $apiRepo = new MercadoPagoApi();
    return $apiRepo->getOrder('1656653618');
});

Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->name('home');

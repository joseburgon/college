<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

JsonApi::register('v1')->routes(function($api) {
    $api->resource('transactions')->relationships(function ($api) {
        $api->hasOne('reference-codes');
    });
    $api->resource('reference-codes')->relationships(function ($api) {
        $api->hasOne('students');
    });
    $api->resource('students');
});

Route::namespace('Api')->prefix('api/v1')->group(function () {

    Route::post('register', 'RegisterController@register');
    Route::post('login', 'LoginController@login')->name('api.v1.login');
    Route::post('logout', 'LoginController@logout');

    Route::post('reference', 'ReferenceCodeController@store')->name('api.reference');

    Route::post('notifications', function (Request $request) {
        Log::info('Mercado Pago notification.', $request->input());
        return response('Success', 200);
    })->name('api.notifications');

    Route::post('transactions/mercadopago', 'TransactionController@mercadopago')->name('api.transactions.mercadopago');

    Route::post('transactions/paypal', 'TransactionController@paypal')->name('api.transactions.paypal');

    Route::apiResources([
        'courses' => 'CourseController',
    ]);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('Api')->group(function () {

    Route::post('reference', 'ReferenceCodeController@store')->name('api.reference');
    
    Route::post('notifications', function (Request $request) {
        Log::info('Mercado Pago notification.', $request->input());
        return response('Success', 200);
    })->name('api.notifications');

    Route::apiResources([
        'courses' => 'CourseController',
        'transactions' => 'TransactionController',
        'students' => 'StudentController',
    ]);
});

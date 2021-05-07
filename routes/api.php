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

Route::get('user', 'Api\AuthUserController@show')->middleware('auth:sanctum');

Route::namespace('Api')->prefix('api')->group(function () {
    Route::apiResources([
        'courses' => 'CourseController',
        'students' => 'StudentController',
    ]);

    Route::post('reference', 'ReferenceCodeController@store')->name('api.reference');

    Route::get('transactions/count-approved', 'TransactionController@countApproved')->name('api.transactions.countApproved');

    Route::post('transactions/mercadopago', 'TransactionController@mercadopago')->name('api.transactions.mercadopago');

    Route::post('transactions/paypal', 'TransactionController@paypal')->name('api.transactions.paypal');

    Route::post('transactions/hotmart', 'TransactionController@hotmart')->name('api.transactions.hotmart');

    Route::get('enrollments/all-historic', 'EnrollmentController@allHistoricEnrolledExport')->name('api.enrollments.not-enrolled');

    Route::get('enrollments/not-enrolled', 'EnrollmentController@notEnrolledExport')->name('api.enrollments.not-enrolled');

    Route::get('enrollments/{course}/current', 'EnrollmentController@exportCurrent')->name('api.enrollments.exportCurrent');

    Route::get('enrollments/{course}/completed', 'EnrollmentController@exportCompleted')->name('api.enrollments.exportCompleted');

    Route::post('students/imports', 'StudentController@import')->name('api.students.import');
});

Route::namespace('Api')->prefix('api/v1')->group(function () {
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'LoginController@login')->name('api.v1.login');
    Route::post('logout', 'LoginController@logout');
});

JsonApi::register('v1')->routes(function($api) {
    $api->resource('transactions')->relationships(function ($api) {
        $api->hasOne('reference-codes');
    })->middleware('auth');

    $api->resource('reference-codes')->relationships(function ($api) {
        $api->hasOne('students');
    });

    $api->resource('students')->middleware('auth');
});

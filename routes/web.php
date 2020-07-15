<?php

use App\Repositories\ThinkificApi;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('thinkific', function () {
    $apiRepo = new ThinkificApi();

    $data = [
        'email' => 'test3@email.com',
        'first_name' => 'Test Name',
        'last_name' => 'Test LastName',
        'password' => '12345678',
        'roles' => ["affiliate"],
        'affiliate_commission' => 0,
        'affiliate_payout_email' => 'test3@email.com',
    ];

    $response = $apiRepo->createUser($data);
    dd($response['id']);
});

Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->name('home');

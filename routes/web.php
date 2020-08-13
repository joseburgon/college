<?php

use App\Mail\TestEmail;
use App\Mail\ThinkificCredentials;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Auth::routes();

Route::get('testing', function () {

    $userData = [
        'email' => 'some@mail.copm',
        'password' => 'password',
    ];

    Mail::to('some@mail.com')->queue(new ThinkificCredentials($userData));
    return '<h1>Enviado!</h1>';
});

Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->name('home');

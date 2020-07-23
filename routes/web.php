<?php

use App\Mail\ThinkificCredentials;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('email', function () {

    Mail::to('joseburgon9@gmail.com')->queue(new ThinkificCredentials('Data'));

    return "Enviado!";

});

Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->name('home');

<?php

use App\Mail\ThinkificCredentials;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->name('home');

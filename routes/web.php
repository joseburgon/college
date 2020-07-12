<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->name('home');

<?php

use Illuminate\Support\Facades\Route;

Route::get('/debug-sentry', function () {
    throw new Exception('Testing Sentry errors!');
});

Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->name('home');

<?php
use App\Mail\TestEmail;
use App\Mail\ThinkificCredentials;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('resend', function () {
    $userData = [
        'first_name' => 'Testing',
        'email' => 'testing@yahoo.com',
        'password' => 'OElYuuQA',
    ];

    Mail::to('team@livingroomcollege.org')->send(new ThinkificCredentials($userData));
    return '<h1>Enviado!</h1>';
});

Auth::routes();

Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->name('home');

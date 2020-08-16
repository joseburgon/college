<?php
use App\Mail\TestEmail;
use App\Mail\ThinkificCredentials;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('resend', function () {
    $userData = [
        'first_name' => 'Julio Mario',
        'email' => 'julioma73@hotmail.com',
        'password' => '9ax39FUi',
    ];

    Mail::to('team@livingroomcollege.org')->send(new ThinkificCredentials($userData));
    return '<h1>Enviado!</h1>';
});

Auth::routes();

Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->name('home');

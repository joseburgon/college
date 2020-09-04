<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ReferenceCode;
use App\Models\Transaction;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['MERCADOPAGO', 'PAYPAL']),
        'status_detail' => 'accredited',
        'payment_method_id' => $faker->randomElement(['pse', 'amex', 'ticket']),
        'status' => $faker->randomElement(['approved', 'rejected', 'pending']),
        'external_reference' => factory(ReferenceCode::class),
        'description' => $faker->sentence(3)
    ];
});

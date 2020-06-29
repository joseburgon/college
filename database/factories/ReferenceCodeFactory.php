<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ReferenceCode;
use Faker\Generator as Faker;

$factory->define(ReferenceCode::class, function (Faker $faker) {
    return [
        'prefix' => $faker->word,
    ];
});

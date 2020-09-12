<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'tagline' => $faker->sentence(3),
        'description' => $faker->sentence(6),
        'price' => rand(80000, 140000),
        'price_usd' => rand(20, 40),
        'cohort' => $faker->word,
        'thinkific_id' => rand(),
        'available_at' => Carbon::now()
    ];
});

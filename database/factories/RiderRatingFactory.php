<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RiderRating;
use Faker\Generator as Faker;

$factory->define(RiderRating::class, function (Faker $faker) {
    return [
        'rating' => Arr::random(range(1, 5)),
    ];
});

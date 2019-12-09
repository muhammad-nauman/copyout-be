<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\VendorRating;
use Faker\Generator as Faker;

$factory->define(VendorRating::class, function (Faker $faker) {
    return [
        'rating' => Arr::random(range(1, 5)),
    ];
});

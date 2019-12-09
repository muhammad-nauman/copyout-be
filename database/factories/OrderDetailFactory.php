<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderDetail;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'file_name' => $faker->imageUrl(640, 480),
        'file_type' => 'image',
        'no_of_sets' => rand(1, 10),
        'no_of_pages' => rand(1, 20),
        'amount' => rand(2, 15),
        'amount_decimal' => rand(2, 99),
        'status' => rand(0, 1),
    ];
});

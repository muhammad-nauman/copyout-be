<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'total_amount' => rand(10, 499),
        'amount_decimal' => rand(0, 99),
        'payment_type' => rand(0, 1),
        'status' => rand(0, 5),
        'due_at' => Carbon::now()->addMinutes(rand(1440, 14400)),
    ];
});

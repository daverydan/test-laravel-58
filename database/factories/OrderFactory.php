<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'item_count' => rand(1,10),
    ];
});

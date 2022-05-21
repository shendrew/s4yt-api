<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coin;
use Faker\Generator as Faker;

$factory->define(Coin::class, function (Faker $faker) {
    return [
        'user_id' => (App\User::inRandomOrder()->first())->id
    ];
});

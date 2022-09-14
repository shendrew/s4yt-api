<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Coin;
use Faker\Generator as Faker;

$factory->define(Coin::class, function (Faker $faker) {
    return [
        'player_id' => (App\Models\Player::inRandomOrder()->first())->id,
        'coin_type_id' => (App\Models\CoinType::getTypeByKey(\App\Models\CoinType::TYPE_REGISTER))
    ];
});

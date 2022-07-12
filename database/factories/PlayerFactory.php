<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(\App\Models\Player::class, function (Faker $faker) {

    $gradeIDs = DB::table('grades')->pluck('id');
    $educationIDs = DB::table('educations')->pluck('id');

    return [
        'grade_id' => $faker->randomElement($gradeIDs),
        'education_id' => $faker->randomElement($educationIDs),
        'country_iso' => 'CA',
        'state_iso' => 'ON',
        'city_id' => 16152
    ];
});

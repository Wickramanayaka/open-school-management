<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'latitude' => $faker->latitude($min = -90, $max = 90) ,
        'longitude' => $faker->longitude($min = -180, $max = 180)
    ];
});

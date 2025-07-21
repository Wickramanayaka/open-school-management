<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {
    return [
        'surname' => $faker->lastName,
        'first_name' => $faker->firstName,
        'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'id_number' => $faker->unique()->numberBetween(500000,5000000),
        'gender' => $faker->numberBetween(0,1)==0?'Male':'Female',
        'address_id' => $faker->numberBetween(1,100),
        'telephone' => $faker->phoneNumber,
        'email' => $faker->email,
        'present_class_room_id' => $faker->numberBetween(1,10),
        'photo' => '2.jpg',
        'admission_number' => $faker->unique()->numberBetween(5,999999),
    ];
});

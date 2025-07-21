<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    // return [
    //     'admission_number' => $faker->unique()->numberBetween(1,999999),
    //     'admitted_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
    //     'admitted_academic_year_id' => $faker->numberBetween(1,6),
    //     'admitted_class_room_id' => $faker->numberBetween(1,15),
    //     'house_id' => $faker->numberBetween(1,3) ,
    //     'cluster_id' => $faker->numberBetween(1,2) ,
    //     'surname' => $faker->lastName,
    //     'first_name' => $faker->firstName,
    //     'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
    //     'gender' => 'Male',
    //     'address_id' => $faker->numberBetween(1,100),
    //     'photo' => '1.jpg',
    //     'present_class_room_id' => $faker->numberBetween(1,152),
    //     'emergency_contact_id' => 1,
    //     'transport_id' => $faker->numberBetween(1,5),
    //     'distance' => $faker->numberBetween(1,15),
    //     'town' => $faker->city,
    //     'student_parent_id' => 1
    // ];
    return [
        'admission_number' => $faker->unique()->numberBetween(1,999),
        'admitted_date' => '2017-01-01',
        'admitted_academic_year_id' => 1,
        'admitted_class_room_id' => $faker->numberBetween(1,5),
        'house_id' => $faker->numberBetween(1,3) ,
        'cluster_id' => $faker->numberBetween(1,2) ,
        'surname' => $faker->lastName,
        'first_name' => $faker->firstName,
        'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => 'Male',
        'address_id' => $faker->numberBetween(1,100),
        'photo' => '1.jpg',
        'present_class_room_id' => $faker->numberBetween(1,5),
        'emergency_contact_id' => 1,
        'transport_id' => $faker->numberBetween(1,5),
        'distance' => $faker->numberBetween(1,15),
        'town' => $faker->city,
        'student_parent_id' => 1
    ];
});

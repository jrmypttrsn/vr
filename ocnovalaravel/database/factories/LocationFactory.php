<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    $city = $faker->city;
    return [
        'name' => $city,
        'address1' => $faker->streetName,
        'address2' => $faker->secondaryAddress,
        'city' => $city,
        'state' => $faker->state,
        'postal_code' => $faker->postcode,
    ];
});

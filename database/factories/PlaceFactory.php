<?php

use Faker\Generator as Faker;

$factory->define(Parking\Place::class, function (Faker $faker) {
    return [
        'available' => rand(0, 1),
    ];
});

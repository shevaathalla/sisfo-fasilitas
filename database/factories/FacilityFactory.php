<?php

namespace Database\Factories;

use App\Facility;
use Faker\Generator as Faker;

$factory->define(Facility::class, function (Faker $faker) {
    $types = ['laboratorium', 'alat-alat'];
    return [
        'name' => $faker->unique()->colorName,
        'type' => $faker->randomElement($types)
    ];
});

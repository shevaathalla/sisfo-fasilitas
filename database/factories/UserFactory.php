<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(User::class, function (Faker $faker) {
    $majors = ["Teknik Informatika", "Matematika", "Kimia", "Fisika", "Arsitek"];

    $faculties = "Saintek";

    return [
        'nim' => $faker->numerify("########"),
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'major' => $faker->randomElement($majors),
        'faculty' => $faculties,
        'type' => "student",
        'email_verified_at' => now(),
        'password' => "password",
        'remember_token' => Str::random(10),
    ];
});

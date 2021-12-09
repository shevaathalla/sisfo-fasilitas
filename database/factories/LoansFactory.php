<?php
namespace Database\Factories;

use App\Facility;
use App\Loan;
use App\User;
use Faker\Generator as Faker;

$factory->define(Loan::class, function (Faker $faker) {
    $users = User::pluck('id')->toArray();
    $facilities = Facility::pluck('id')->toArray();
    return [
        "user_id" => $faker->randomElement($users),
        "facility_id" => $faker->randomElement($facilities),
        "reason" => $faker->sentence(100),
        "proposal" => $faker->word().".pdf",
        "department_verification" => $faker->boolean(),
        "faculty_verification" => $faker->boolean(),
    ];
});

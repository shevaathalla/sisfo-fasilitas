<?php

namespace Database\Factories;

use App\Laboratorium;
use App\LoanLaboratorium;
use App\Model;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanLaboratoriumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoanLaboratorium::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();        

        return [
            "user_id" => $this->faker->randomElement($users),
            "laboratorium_id" => 1,            
            "reason" => $this->faker->sentence(6),            
            "proposal" => $this->faker->url,
            "department_verification" => $this->faker->boolean(),
            "faculty_verification" => $this->faker->boolean(),            
        ];
    }
}

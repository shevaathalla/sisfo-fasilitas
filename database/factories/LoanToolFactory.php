<?php

namespace Database\Factories;

use App\Laboratorium;
use App\LoanTool;
use App\Tool;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanToolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoanTool::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $tools = Tool::pluck('id')->toArray();

        return [
            "user_id" => $this->faker->randomElement($users),
            "tool_id" => $this->faker->randomElement($tools),
            "quantity" => $this->faker->numberBetween(0,10),
            "reason" => $this->faker->sentence(6),            
            "proposal" => $this->faker->url,
            "department_verification" => $this->faker->boolean(),
            "faculty_verification" => $this->faker->boolean()
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\Gym;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GymManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            /*'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'gymmanager',
           'avatar'=>'uploads/gymmangers',
           'gym_id'=>Gym::factory(),
            */
            'national_id' => $this->faker->unique()->randomNumber(),
            'user_id' => User::factory(),
            'gym_id' => Gym::factory()
        ];
    }
}

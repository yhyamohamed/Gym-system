<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\Gym;
use App\Models\User;

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
        $allGymManagersID = User::where('position_id',3)->pluck('id');
        return [
            'NID' => $this->faker->unique()->numerify('##############'),
            'user_id' =>  $this->faker->unique()->randomElement($allGymManagersID),
            'gym_id' => Gym::factory()
        ];
    }
}

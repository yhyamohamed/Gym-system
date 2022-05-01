<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\TrainingPackage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingSession>
 */
class TrainingSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'start_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'finish_at' => $this->faker->dateTimeBetween('+1 week', '+2 week'),
            'training_package_id' => TrainingPackage::factory(),
        ];
    }
}

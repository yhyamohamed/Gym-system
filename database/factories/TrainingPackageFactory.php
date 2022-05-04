<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Gym;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingPackage>
 */
class TrainingPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numerify('######'),
            'total_Sessions' => $this->faker->numberBetween($min = 5, $max = 25),
           'gym_id'=>Gym::factory(),
        ];
    }
}

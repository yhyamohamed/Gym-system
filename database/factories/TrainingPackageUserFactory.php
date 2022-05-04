<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\TrainingPackage;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TrainingPackageUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'remaining_sessions' => $this->faker->numberBetween($min = 0, $max = 24),
           'user_id'=>User::factory(),
           'amount_paid'=>$this->faker->numerify('#####'),
           'training_package_id'=>TrainingPackage::factory(),
        ];
    }
}

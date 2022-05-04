<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\CityManager;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gym>
 */
class GymFactory extends Factory
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
            'creator' =>   $this->faker->name(),
            'city_manager_id' =>  CityManager::factory(),
           'cover_img'=>'uploads/gymsCovrs'
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\CityManager;
use App\Models\User;

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
        $allCityManagersID = CityManager::all()->pluck('id');
        return [
            'name' => $this->faker->name(),
            'creator' =>   $this->faker->name(),
            'city_manager_id' =>   $this->faker->randomElement($allCityManagersID),
            'cover_img' => 'uploads/gymsCovrs'
        ];
    }
}

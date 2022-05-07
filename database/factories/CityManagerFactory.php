<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CityManager>
 */
class CityManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $allCityManagersID = User::where('position_id',2)->pluck('id');
        return [
            'NID' => $this->faker->unique()->numerify('##############'),
            'user_id' =>  $this->faker->unique()->randomElement($allCityManagersID),
            'city_name' => $this->faker->unique()->randomElement(['Alexandria','Aswan','Cairo','Siwa','Dahab'])
        ];
    }
}

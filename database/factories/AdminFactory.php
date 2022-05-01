<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
   
    public function definition()
    {
        return [
            'email' =>'admin@admin.com',
            'password' => 12345,
        ];
    }
}

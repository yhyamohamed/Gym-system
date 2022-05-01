<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\models\CityManager::factory(3)->create();
        \App\models\Gym::factory(3)->create();
        \App\models\CityManager::factory()->hasgyms(3)->create();
        \App\models\GymManager::factory()->create();
        \App\models\TrainingPackage::factory()->count(4)->create();
        \App\models\Coach::factory(3)->create();
        \App\models\TrainingSession::factory()->count(3)->create();
        \App\models\coachTrainingSession::factory()->count(2)->create();
        \App\models\TrainingPackageUser::factory()->count(2)->create();
    }
}

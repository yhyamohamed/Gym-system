<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\models\CityManager;
use App\Models\Position;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PositionSeeder::class);
        \App\Models\User::factory(20)->create();
        \App\Models\CityManager::factory(3)->create();
        \App\Models\Gym::factory(3)->create();
        \App\Models\CityManager::factory()->hasgyms(3)->create();
        \App\Models\GymManager::factory()->create();
        \App\Models\TrainingPackage::factory()->count(4)->create();
        \App\Models\Coach::factory(3)->create();
        \App\Models\TrainingSession::factory()->count(3)->create();
        \App\Models\coachTrainingSession::factory()->count(2)->create();
        \App\Models\TrainingPackageUser::factory()->count(2)->create();
        \App\Models\TrainingSessionUser::factory()->count(2)->create(['user_id' => 1, 'training_session_id' => 1]);
    }
}

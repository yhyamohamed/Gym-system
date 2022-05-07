<?php

namespace Database\Seeders;

use App\Models\Coach;
use App\Models\coachTrainingSession;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\TrainingPackage;
use App\Models\TrainingPackageUser;
use App\Models\TrainingSession;
use App\Models\TrainingSessionUser;
use Illuminate\Database\Seeder;
use \App\Models\CityManager;
use App\Models\User;



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
        User::factory(20)->create();
        CityManager::factory(3)->create();
        Gym::factory(3)->create();
        CityManager::factory()->hasgyms(3)->create();
        GymManager::factory(User::where('position_id',3)->count())->create();
        TrainingPackage::factory()->count(4)->create();
        Coach::factory(3)->create();
        TrainingSession::factory()->count(3)->create();
        coachTrainingSession::factory()->count(2)->create();
        TrainingPackageUser::factory()->count(2)->create();
        TrainingSessionUser::factory()->count(2)->create(['user_id' => 1, 'training_session_id' => 1]);
    }
}

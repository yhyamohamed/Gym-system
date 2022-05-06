<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PossessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('possessions')->insert(
            [
                [
                    'possession' => 'admin',
                ],
                [
                    'possession' => 'city_manager',
                ],
                [
                    'possession' => 'gym_manager',
                ],
                [
                    'possession' => 'user',
                ]
            ]
        );
    }
}

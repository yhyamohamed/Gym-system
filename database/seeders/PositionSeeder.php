<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert(
            [
                [
                    'position' => 'admin',
                ],
                [
                    'position' => 'city_manager',
                ],
                [
                    'position' => 'gym_manager',
                ],
                [
                    'position' => 'user',
                ]
            ]
        );
    }
}

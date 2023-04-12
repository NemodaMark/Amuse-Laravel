<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            ['Genre' => 'Action'],
            ['Genre' => 'Action-adventure'],
            ['Genre' => 'Adventure'],
            ['Genre' => 'Puzzle'],
            ['Genre' => 'Role-playing'],
            ['Genre' => 'Simulation'],
            ['Genre' => 'Strategy'],
            ['Genre' => 'Sports'],
            ['Genre' => 'MMO'],
            ['Genre' => 'Sandbox'],
        ];

        DB::table('genres')->insert($genres);
    }
}

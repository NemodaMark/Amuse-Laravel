<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed games table
        $games = [
            [
                'title' => 'Super Mario Bros.',
                'price' => 29.99,
                'genreID' => 1,
                'added' => now(),
                'creator' => 1,
                'description' => 'A classic platformer game featuring Mario.',
                'link' => ''
            ],
            [
                'title' => 'The Legend of Zelda: Breath of the Wild',
                'price' => 59.99,
                'genreID' => 2,
                'added' => now(),
                'creator' => 2,
                'description' => 'An action-adventure game featuring Link.',
                'link' => ''
            ],
            [
                'title' => 'Minecraft',
                'price' => 26.95,
                'genreID' => 3,
                'added' => now(),
                'creator' => 3,
                'description' => 'A sandbox game where players can build and explore.',
                'link' => ''
            ],
            [
                'title' => 'FIFA 22',
                'price' => 59.99,
                'genreID' => 4,
                'added' => now(),
                'creator' => 4,
                'description' => 'A sports simulation game featuring football.',
                'link' => ''
            ]
        ];

        DB::table('games')->insert($games);
    }
}

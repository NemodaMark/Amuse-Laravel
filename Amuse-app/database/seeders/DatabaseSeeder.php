<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        User::factory(10)->create();
        $this->call(GenreSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(GamesSeeder::class);

         //App\Models\User::factory()->create([
         //    'name' => 'Test User2',
         //    'username' => 'Test Dummy2',
         //    'email' => 'test@example2.com'
         //]);
    }
}

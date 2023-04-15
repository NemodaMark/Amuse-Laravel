<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['role' => 'user'],
            ['role' => 'staff'],
            ['role' => 'admin'],
            ['role' => 'owner'],
        ];
    
        DB::table('roles')->insert($roles);
    }
    
}

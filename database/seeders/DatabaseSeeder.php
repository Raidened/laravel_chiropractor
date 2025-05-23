<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->insert([
            'name' => "nonodubendo",
            'email' => "nonodubendo@gmail.com",
            'password' => bcrypt('azertyuiop'),
        ]);
        DB::table('users')->insert([
            'name' => "Dr.Smith",
            'email' => "smith@gmail.com",
            'password' => bcrypt('password'),
            'rank' => 1,
        ]);
        DB::table('users')->insert([
            'name' => "Dr.John",
            'email' => "john@gmail.com",
            'password' => bcrypt('password'),
            'rank' => 1,
        ]);

    }
}

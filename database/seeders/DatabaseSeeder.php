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
            'rank'=>1
        ]);
        DB::table('users')->insert([
            'name' => "Dr.Emmoroide",
            'email' => "emmoroide@gmail.com",
            'password' => bcrypt('password'),
            'rank'=>1
        ]);

        DB::table('schedules')->insert([
            'day' => "2025-02-20",
            'hour_start' => "10:00:00",
            'hour_end' => "10:30:00",
        ]);
        DB::table('appointments')->insert([
            'schedule_id' => 1,
            'status' => 0,
            'client_id'=>1,
            'client_note' => "hemoroide",
            'doctor_name' => "Dr.Smith",
            'type' => "douleureux"

        ]);
        DB::table('schedules')->insert([
            'day' => "2025-02-22",
            'hour_start' => "10:00:00",
            'hour_end' => "10:30:00",
        ]);
        DB::table('appointments')->insert([
            'schedule_id' => 2,
            'status' => 0,
            'client_id'=>1,
            'client_note' => "hemoroide",
            'doctor_name' => "Dr.Emmoroide",
            'type' => "douleureux"

        ]);
        DB::table('schedules')->insert([
            'day' => "2025-02-25",
            'hour_start' => "10:00:00",
            'hour_end' => "10:30:00",
        ]);
        DB::table('appointments')->insert([
            'schedule_id' => 3,
            'status' => 0,
            'client_id'=>1,
            'client_note' => "hemoroide",
            'doctor_name' => "Dr.Emmoroide",
            'type' => "douleureux"

        ]);



    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            ['Nama_Users' => 'Admin Restoran SN','Email_Users' => 'admin@gmail.com', 'Password_Users' =>'admin', 'ID_User_Roles'=>'1'],
        ]);

        DB::table('users_role')->insert([
            ['Role' => 'Admin'],
            ['Role' => 'SPV Owner'],
            ['Role' => 'Kasir'],
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
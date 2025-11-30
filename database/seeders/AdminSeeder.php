<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'AdminMardika',
            'email' => 'MardikaStore27@gmail.com',
            'password' => bcrypt('MardikaStore27'),
            'role' => 'admin',
            'status' => 'approved',
        ]);
        
    }
}

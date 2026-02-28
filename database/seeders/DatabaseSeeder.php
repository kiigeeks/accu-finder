<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'fullname' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
            'roles' => 'admin',
            'is_active' => true,
        ]);
        User::create([
            'fullname' => 'Admin 2',
            'email' => 'admin2@mail.com',
            'password' => bcrypt('123456'),
            'roles' => 'admin',
            'is_active' => true,
        ]);
    }
}

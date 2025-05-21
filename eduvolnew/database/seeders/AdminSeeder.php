<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'EDU Volunteer',
            'birth_date' => '1990-01-01',
            'profession' => 'Administrator',
            'domicile' => 'Jakarta',
            'email' => 'admin@eduvolunteer.com',
            'password' => Hash::make('admin123'),
            'terms_agreed' => true,
            'role_id' => 1, // role_id 1 untuk admin
        ]);
    }
} 
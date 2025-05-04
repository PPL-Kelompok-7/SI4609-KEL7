<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
            'birth_date' => '1990-01-01',
            'profession' => 'Software Engineer',
            'domicile' => 'Jakarta',
            'terms_agreed' => true,
            'role_id' => 3, // Participant role
            'mobile_phone' => '081234567890'
        ]);
    }
}

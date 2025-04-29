<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Roles
        $roles = [
            ['name' => 'admin', 'description' => 'Administrator'],
            ['name' => 'volunteer', 'description' => 'Volunteer User'],
            ['name' => 'partner', 'description' => 'Partner Organization']
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Create Admin User
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'email' => 'admin@eduvolunteer.com',
            'password' => Hash::make('admin123'),
            'role_id' => 1, // admin role
            'phone_number' => '08123456789',
            'address' => 'Bandung, Indonesia',
        ]);

        // Create Sample Volunteer Users
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
            'role_id' => 2, // volunteer role
            'phone_number' => '08123456790',
            'address' => 'Cakung, Jawa Selatan',
        ]);

        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'password' => Hash::make('password123'),
            'role_id' => 2, // volunteer role
            'phone_number' => '08123456791',
            'address' => 'Jakarta, Indonesia',
        ]);

        // Create Sample Partner
        User::create([
            'first_name' => 'Education',
            'last_name' => 'Foundation',
            'email' => 'partner@example.com',
            'password' => Hash::make('password123'),
            'role_id' => 3, // partner role
            'phone_number' => '08123456792',
            'address' => 'Surabaya, Indonesia',
        ]);
    }
} 
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birth_date' => $this->faker->date('Y-m-d', '2000-01-01'),
            'profession' => $this->faker->jobTitle,
            'domicile' => $this->faker->city,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password default
            'mobile_phone' => $this->faker->phoneNumber,
            'profile_photo' => null,
            'terms_agreed' => 1,
            'role_id' => 1, // sesuaikan role_id default di db kamu
            'remember_token' => Str::random(10),
            'target_hours' => 50,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'registration_id' => $this->faker->numberBetween(1, 10),
            'amount' => $this->faker->randomFloat(2, 10000, 500000),
            'payment_method_id' => $this->faker->numberBetween(1, 3),
            'payment_status_id' => $this->faker->numberBetween(1, 5),
            'proof_of_payment' => null,
            'payment_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'user_id' => 1,
        ];
    }
}

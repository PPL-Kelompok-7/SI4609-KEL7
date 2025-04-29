<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'Bank Transfer'],
            ['name' => 'E-Wallet'],
            ['name' => 'Credit Card'],
            ['name' => 'Debit Card']
        ];

        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}

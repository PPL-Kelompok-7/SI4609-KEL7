<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentStatus;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Pending'],
            ['name' => 'Processing'],
            ['name' => 'Completed'],
            ['name' => 'Failed'],
            ['name' => 'Refunded']
        ];

        foreach ($statuses as $status) {
            PaymentStatus::create($status);
        }
    }
}

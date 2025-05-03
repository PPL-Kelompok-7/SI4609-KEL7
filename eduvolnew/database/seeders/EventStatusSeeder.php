<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventStatus;

class EventStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Draft'],
            ['name' => 'Published'],
            ['name' => 'Ongoing'],
            ['name' => 'Completed'],
            ['name' => 'Cancelled']
        ];

        foreach ($statuses as $status) {
            EventStatus::create($status);
        }
    }
}

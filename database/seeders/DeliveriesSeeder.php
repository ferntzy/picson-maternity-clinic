<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Deliveries;

class DeliveriesSeeder extends Seeder
{
    public function run(): void
    {
        Deliveries::firstOrCreate(
            ['type_of_delivery' => 'vaginal'],
            ['profile_id' => null, 'time_of_delivery' => now()]
        );

        Deliveries::firstOrCreate(
            ['type_of_delivery' => 'cesarean'],
            ['profile_id' => null, 'time_of_delivery' => now()]
        );
    }
}

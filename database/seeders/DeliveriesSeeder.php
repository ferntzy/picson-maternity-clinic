<?php

namespace Database\Seeders;

use App\Models\Deliveries;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DeliveriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Deliveries::create([
            'time_of_delivery' => Carbon::now(),
            'type_of_delivery' => 'Normal Spontaneous Delivery',
            'patient_id' => 1, // existing patient
        ]);
    }
}

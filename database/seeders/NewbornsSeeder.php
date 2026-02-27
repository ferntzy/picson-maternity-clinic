<?php

namespace Database\Seeders;

use App\Models\Deliveries;
use App\Models\Newborns;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class NewbornsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $delivery = Deliveries::create([
            'time_of_delivery' => '14:45:20',
            'type_of_delivery' => 'Normal',
            'profile_id' => 1
        ]);

        Newborns::create([
            'delivery_id' => $delivery->id,
            'sex' => 'Male',
            'birth_weight' => 7.5,
            'firstname' => 'Roland',
            'middlename' => 'Rory',
            'lastname' => 'Balabat',
            'date_time_of_birth' => '2025-02-27 14:30:00',
            'head' => 38,
            'chest' => 30,
            'abdomen' => 32,
            'length' => 49,
            'newborn_screening_done' => '2025-02-27'
        ]);
    }
}

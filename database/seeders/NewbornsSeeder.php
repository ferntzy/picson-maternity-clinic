<?php

namespace Database\Seeders;

use App\Models\Deliveries;
use App\Models\Newborns;
use App\Models\Profiles;
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
            'time_of_delivery' => '2025-02-27 14:30:00',
            'type_of_delivery' => 'normal',
            'profile_id' => 1
        ]);

        $profile = Profiles::create([
            'firstname' => 'Robert',
            'middlename' => 'Solana',
            'lastname' => 'Miguel',
            'sex' => 'Male',
            'address' => 'Inopacan, Leyte',
            'role' => 'newborn'
        ]);

        Newborns::create([
            'delivery_id' => $delivery->id,
            'newborn_screening_done' => '2025-02-27',
            'profile_id' => $profile->id
        ]);
    }
}

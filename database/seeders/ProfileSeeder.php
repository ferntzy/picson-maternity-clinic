<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profiles')->insertOrIgnore([
            [
                'id'                       => 1,
                'firstname'                => 'Rovic Kristian',
                'middlename'               => 'Comendador',
                'lastname'                 => 'Laniog',
                'role_id'                  => 1,
                'address'                  => 'San Vicente, Malitbog, Southern Leyte',
                'sex'                      => 'M',
                'birth_place'              => 'Maasin City',
                'civil_status'             => 'Single',
                'religion'                 => 'Roman Catholic',
                'nationality'              => 'Filipino',
                'birth_date'               => '2026-03-02 00:00:00',
                'emergency_contact_name'   => null,
                'emergency_contact_number' => null,
                'philhealth_number'        => null,
                'blood_type'               => 'A+',
                'allergies'                => null,
                'contact_num'              => '09631001435',
            ],
            [
                'id'                       => 2,
                'firstname'                => 'vejee',
                'middlename'               => 'balabat ',
                'lastname'                 => 'bayot',
                'role_id'                  => 4,
                'address'                  => 'sada ',
                'sex'                      => 'M',
                'birth_place'              => 'asdad',
                'civil_status'             => 'Married',
                'religion'                 => '1313 ',
                'nationality'              => '18 days',
                'birth_date'               => '1902-03-02 00:00:00',
                'emergency_contact_name'   => null,
                'emergency_contact_number' => '093131131',
                'philhealth_number'        => null,
                'blood_type'               => 'O+',
                'allergies'                => 'None',
                'contact_num'              => '90211212',
            ],
            [
                'id'                       => 3,
                'firstname'                => 'lester',
                'middlename'               => 'bayot',
                'lastname'                 => 'kaayo',
                'role_id'                  => 5,
                'address'                  => 'Hilongos Leyte',
                'sex'                      => 'male',
                'birth_place'              => 'asdad',
                'civil_status'             => 'single',
                'religion'                 => '1313 ',
                'nationality'              => '18 days',
                'birth_date'               => '2026-03-05 00:00:00',
                'emergency_contact_name'   => null,
                'emergency_contact_number' => null,
                'philhealth_number'        => null,
                'blood_type'               => 'O+',
                'allergies'                => 'None',
                'contact_num'              => '7097879',
            ],
        ]);
    }
}

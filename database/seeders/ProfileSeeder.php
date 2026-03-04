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
                'role'                     => 'admin',
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
                'created_at'               => null,
                'updated_at'               => '2026-03-02 05:12:14',
                'deleted_at'               => null,
            ],
            [
                'id'                       => 2,
                'firstname'                => 'vejee',
                'middlename'               => 'balabat ',
                'lastname'                 => 'bayot',
                'role'                     => 'nurse',
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
                'created_at'               => '2026-03-02 04:43:55',
                'updated_at'               => '2026-03-02 06:18:29',
                'deleted_at'               => null,
            ],
            [
                'id'                       => 3,
                'firstname'                => 'lester',
                'middlename'               => 'bayot',
                'lastname'                 => 'kaayo',
                'role'                     => null,
                'role_id'                  => null,
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
                'created_at'               => '2026-03-02 05:02:25',
                'updated_at'               => '2026-03-02 05:02:25',
                'deleted_at'               => null,
            ],
        ]);
    }
}

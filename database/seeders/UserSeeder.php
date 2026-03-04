<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
            [
                'id'         => 1,
                'email'      => 'rolaniog@gmail.com',
                'password'   => '$2y$12$QOFi0J.1Da6ca7OFEl8EEO5nBPMKpjh1aHZgFTICWNz7Zn11HcPZq',
                'avatar'     => 'avatars/01KJSZZB30PYMJECN6W1F25PQ2.jpg',
                'profile_id' => 1,
                'created_at' => null,
                'updated_at' => '2026-03-03 06:00:03',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'email'      => 'fernmlbb14@gmail.com',
                'password'   => '$2y$12$l.B7kJV48zuuqjtPfh3n9Oqgbge.tIfJqoQ.Hn28Yd.zCOvnV/lIu',
                'avatar'     => 'avatars/01KJQ98PY1B7BQP9HR5ZJNAXTK.jpg',
                'profile_id' => 2,
                'created_at' => '2026-03-02 04:44:44',
                'updated_at' => '2026-03-02 04:44:44',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'email'      => 'asd@gmail.com',
                'password'   => '$2y$12$Stw1GeJVf22.xMgG4mXEMelDu1B.lmO4vu9CRiP9.W3ECu4K/vmoS',
                'avatar'     => null,
                'profile_id' => 3,
                'created_at' => '2026-03-02 05:08:11',
                'updated_at' => '2026-03-02 05:10:10',
                'deleted_at' => '2026-03-02 05:10:10',
            ],
            [
                'id'         => 4,
                'email'      => 'asd@dasdas',
                'password'   => '$2y$12$ohILe1U.M6yeEhhrNw6NzuBqduYGYKgJIDi78vMqA7dvRtw5yiBgu',
                'avatar'     => null,
                'profile_id' => 3,
                'created_at' => '2026-03-02 05:10:32',
                'updated_at' => '2026-03-02 05:15:56',
                'deleted_at' => '2026-03-02 05:15:56',
            ],
            [
                'id'         => 5,
                'email'      => 'asd123@gmail.com',
                'password'   => '$2y$12$BOcLprX6OC/Hmzt8HxCrYeCJVdw7JFbrQ3TBJNL9wcqwO/YCWa8pi',
                'avatar'     => null,
                'profile_id' => 3,
                'created_at' => '2026-03-02 05:16:30',
                'updated_at' => '2026-03-02 05:30:35',
                'deleted_at' => '2026-03-02 05:30:35',
            ],
        ]);
    }
}

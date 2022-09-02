<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class DefaultRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // FORCE TRUNCATE TABLE -- FOR ENABLED FOREIGN KEY CONSTRAINT
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::insert([
            [
                'id' => 1,
                'name' => 'Defult Admin',
                'role_id' => 1,
                'email' => "admin@gmail.com",
                'password'=> bcrypt('12345678'),
                'country_code' => '',
                'mobile' => '+923035190106',
            ],
            [
                'id' => 2,
                'name' => 'Default Vendor',
                'role_id' => 2,
                'email' => "vendor1.tester@gmail.com",
                'password'=> bcrypt('12345678'),
                'country_code' => '',

                'mobile' => '+923035190107',
            ],
            [
                'id' => 3,
                'name' => 'Default Customer',
                'role_id' => 3,
                'email' => "buyer1.storak@gmail.com",
                'password'=> bcrypt('12345678'),
                'country_code' => '',

                'mobile' => '+923035190108',
            ]
        ]);
    }
}

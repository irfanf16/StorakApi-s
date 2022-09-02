<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\SubRole;

class DefaultSubroles extends Seeder
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
        SubRole::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        SubRole::insert([
            [
                'id' => 1,
                'name' => 'Storak Admin',
                'owner_id' => 0,
                'permissions' => json_encode(config('modules-beta.admin'))
            ],
            [
                'id' => 2,
                'name' => 'Vendor Admin',
                'owner_id' => 0,
                'permissions' => json_encode(config('modules-beta.vendor'))
            ]
        ]);

    }
}
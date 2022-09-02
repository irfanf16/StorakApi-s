<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CountriesTableSeeder extends Seeder
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
        DB::table('countries')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // INSERT RECORDS
        DB::table('countries')->insert(
            [
                [
                    'id'   => 1,
                    'name' => 'Qatar',
                    'status' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]
        );
    }
}

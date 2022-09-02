<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FulfillmentsTableSeeder extends Seeder
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
        DB::table('fulfillments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // INSERT RECORDS
        DB::table('fulfillments')->insert(
            [
                [
                    'id'   => 1,
                    'name' => 'free',
                    'background_color' => '#FD8F1F',
                    'description' => 'free delivery -- no charges',
                    'charges' => 0,
                    'status' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'   => 2,
                    'name' => 'economy',
                    'background_color' => '#13548D',
                    'description' => 'economy delivery - basic charges',
                    'charges' => 100,
                    'status' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'   => 3,
                    'name' => 'standard',
                    'background_color' => '#23B198',
                    'description' => 'standard delivery -- normal charges',
                    'charges' => 200,
                    'status' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'   => 4,
                    'name' => 'express',
                    'background_color' => '#CA2C20',
                    'description' => 'fast delivery -- extra charges',
                    'charges' => 400,
                    'status' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]
        );
    }
}

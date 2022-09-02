<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GoodsTypesTableSeeder extends Seeder
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
        DB::table('goods_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // INSERT RECORDS
        DB::table('goods_types')->insert(
            [
                [
                    'id'         => 1,
                    'title'      => 'Hazardous',
                    'description'=> 'it contains hazardous goods.',
                    'status'     => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 2,
                    'title'      => 'Poisonous',
                    'description'=> 'it contains poisonous goods.',
                    'status'     => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 3,
                    'title'      => 'Flammable',
                    'description'=> 'it contains flammable goods.',
                    'status'     => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 4,
                    'title'      => 'Glassy',
                    'description'=> 'it contains glassy goods.',
                    'status'     => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]
        );
    }
}

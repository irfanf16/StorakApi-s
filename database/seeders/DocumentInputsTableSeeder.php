<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DocumentInputsTableSeeder extends Seeder
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
        DB::table('document_inputs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // INSERT RECORDS
        DB::table('document_inputs')->insert(
            [
                [
                    'id'          => 1,
                    'document_id' => 1,
                    'input_name'  => 'Qatar Id Number',
                    'input_type'  => 'text',
                    'input_status'=> 0,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'          => 2,
                    'document_id' => 1,
                    'input_name'  => 'Qatar Id Front Image',
                    'input_type'  => 'file',
                    'input_status'=> 1,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'          => 3,
                    'document_id' => 1,
                    'input_name'  => 'Qatar Id Back Image',
                    'input_type'  => 'file',
                    'input_status'=> 1,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'          => 4,
                    'document_id' => 2,
                    'input_name'  => 'Commercial Registration Number',
                    'input_type'  => 'text',
                    'input_status'=> 0,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'          => 5,
                    'document_id' => 2,
                    'input_name'  => 'Commercial Registration Document',
                    'input_type'  => 'file',
                    'input_status'=> 1,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'          => 6,
                    'document_id' => 3,
                    'input_name'  => 'Municipal License Number',
                    'input_type'  => 'text',
                    'input_status'=> 0,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'          => 7,
                    'document_id' => 3,
                    'input_name'  => 'Municipal License Document',
                    'input_type'  => 'file',
                    'input_status'=> 1,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'          => 8,
                    'document_id' => 4,
                    'input_name'  => 'Company Computer Card Number',
                    'input_type'  => 'text',
                    'input_status'=> 0,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'          => 9,
                    'document_id' => 4,
                    'input_name'  => 'Company Computer Card Document',
                    'input_type'  => 'file',
                    'input_status'=> 1,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'          => 10,
                    'document_id' => 5,
                    'input_name'  => 'Tax Card Number',
                    'input_type'  => 'text',
                    'input_status'=> 0,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'          => 11,
                    'document_id' => 5,
                    'input_name'  => 'Tax Card Document',
                    'input_type'  => 'file',
                    'input_status'=> 1,
                    'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'  => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]
        );
    }
}

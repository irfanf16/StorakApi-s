<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DocumentsTableSeeder extends Seeder
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
        DB::table('documents')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // INSERT RECORDS
        DB::table('documents')->insert(
            [
                [
                    'id'             => 1,
                    'document_title' => 'Qatar Id',
                    'document_status'=> 1,
                    'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'     => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'             => 2,
                    'document_title' => 'Commercial Registration',
                    'document_status'=> 1,
                    'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'     => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'             => 3,
                    'document_title' => 'Municipal License',
                    'document_status'=> 1,
                    'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'     => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'             => 4,
                    'document_title' => 'Company Computer Card',
                    'document_status'=> 1,
                    'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'     => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'             => 5,
                    'document_title' => 'Tax Card',
                    'document_status'=> 1,
                    'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'     => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]
        );
    }
}

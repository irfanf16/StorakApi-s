<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now();
        DB::table('delivery_slots')->insert([
            [
                'name' =>    'First slot',
                'start_time' => '12:00:00',
                'end_time' => '14:00:00',
                'created_at' => $timestamp,
                'updated_at' =>  $timestamp
            ],
            [
                'name' =>    'Second slot',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'created_at' => $timestamp,
                'updated_at' =>  $timestamp
            ],
            [
                'name' =>    'Third slot',
                'start_time' => '16:00:00',
                'end_time' => '18:00:00',
                'created_at' => $timestamp,
                'updated_at' =>  $timestamp
            ],
            ]);
    }
}

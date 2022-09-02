<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SocialLink;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialLink::truncate();
        $timestamp = Carbon::now();

        DB::table('social_links')->insert([
            [
            'title' => 'Google',
            'logo'  => 'google.png',
            'status' => 1,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
            ],
            [
                'title' => 'Facebook',
                'logo'  => 'facebook.png',
                'status' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'title' => 'Apple',
                'logo'  => 'apple.png',
                'status' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
    ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderStatusTableSeeder extends Seeder
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
        DB::table('order_status')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // INSERT RECORDS
        DB::table('order_status')->insert(
            [
                [
                    'id'         => 1,
                    'status'     => 'Pending',
                    'status_for' => 'vendors',
                    'message'    => 'Your order has been placed',
                    'description'=> "Your order placed but it's still pending .We’ll inform when it’s confirm. Don’t forget to check out our latest email..
                    Let us know if you have questions!",
                    'background_color' => '#FFA500',
                    'icon'       => 'https://img.icons8.com/glyph-neue/94/000000/data-pending.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 2,
                    'status'     => 'Accepted',
                    'status_for' => 'vendors',
                    'message'    => 'Your order has been accepted',
                    'description'=> "we’ve received an update that your order has been accepted by the vendor",
                    'background_color' => '#008000',
                    'icon'       => 'https://img.icons8.com/clouds/94/000000/checked--v1.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 3,
                    'status'     => 'Rejected',
                    'status_for' => 'vendors',
                    'message'    => 'Your order has been rejected',
                    'description'=> "we’ve received an update that your order has been rejected by the vendor unfortunately",
                    'background_color' => '#FF0000',
                    'icon'       => 'https://img.icons8.com/fluency/96/000000/delete-forever.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 4,
                    'status'     => 'Cancelled',
                    'status_for' => 'buyers',
                    'message'    => 'You have cancelled your order',
                    'description'=> "You have cancelled your order",
                    'background_color' => '#CA1929',
                    'icon'       => 'https://img.icons8.com/dusk/94/000000/crying--v2.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 5,
                    'status'     => 'Ready to Ship',
                    'status_for' => 'vendors',
                    'message'    => 'Your order is ready to ship',
                    'description'=> "Your order is ready to Ship at our location. We’ll inform when it’s time for you to pick at your address. Don’t forget to check out our latest email.",
                    'background_color' => '#1A78E6',
                    'icon'       => 'https://img.icons8.com/fluency/94/000000/deliver-food.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 6,
                    'status'     => 'Shipped',
                    'status_for' => 'vendors',
                    'message'    => 'Your order has been shipped',
                    'description'=> "We’re excited to say that your order is on the way ! Right now, they’re estimated to arrive around given time period Check out our website to look up the tracking details",
                    'background_color' => '#0067EE',
                    'icon'       => 'https://img.icons8.com/ultraviolet/94/000000/shipped.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 7,
                    'status'     => 'Delivered',
                    'status_for' => 'vendors',
                    'message'    => 'Your order has been delivered',
                    'description'=> "we’ve received an update that your order has been delivered. Let us know how you like your order",
                    'background_color' => '#0FC40F',
                    'icon'       => 'https://img.icons8.com/ultraviolet/94/000000/checked-truck.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 8,
                    'status'     => 'Failed to deliver',
                    'status_for' => 'vendors',
                    'message'    => 'Delivery Failed',
                    'description'=> "Your order delivery has been failed",
                    'background_color' => '#661212',
                    'icon'       => 'https://img.icons8.com/fluency/94/000000/important-delivery.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'id'         => 9,
                    'status'     => 'Returned',
                    'status_for' => 'buyers',
                    'message'    => 'Your order has been returned',
                    'description'=> "we are sorry that you didn’t love your order, but we’re here to make it better!
                    If you’d like to place a new order, feel free to text this line for personal advice!
                    Our team of experts is always happy to help , Thank you.",
                    'background_color' => '#000000',
                    'icon'       => 'https://img.icons8.com/nolan/94/commodity-turnover.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]
        );
    }
}

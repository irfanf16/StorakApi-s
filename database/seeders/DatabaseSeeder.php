<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
//        $this->call(DefaultRoles::class);
//        $this->call(DefaultSubroles::class);
//
//        $this->call(AddressTypesTableSeeder::class);
//        $this->call(CountriesTableSeeder::class);
//        $this->call(CitiesTableSeeder::class);
//        $this->call(FulfillmentsTableSeeder::class);
//
//        $this->call(CitiesTableSeeder::class);
//
//        $this->call(WarrantyPeriodsTableSeeder::class);
//        $this->call(GoodsTypesTableSeeder::class);
//
//        $this->call(DocumentsTableSeeder::class);
//        $this->call(DocumentInputsTableSeeder::class);
//        $this->call(OrderStatusTableSeeder::class);
//        $this->call(DeliverySlotSeeder::class);
//        $this->call(SocialLinkSeeder::class);
//        $this->call(AppSettingSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}

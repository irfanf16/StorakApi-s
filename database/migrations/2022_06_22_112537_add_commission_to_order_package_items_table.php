<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommissionToOrderPackageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_package_items', function (Blueprint $table) {
            $table->float('storak_commission')->nullable()->after('price');
            $table->float('seller_commission')->nullable()->after('storak_commission');
            $table->float('user_store_commission')->nullable()->after('seller_commission');
            $table->string('user_store_reference_key')->nullable()->after('user_store_commission');
            $table->string('storak_commission_percentage')->nullable()->after('user_store_reference_key');
            $table->string('user_store_commission_percentage')->nullable()->after('seller_commission_percentage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_package_items', function (Blueprint $table) {
            $table->dropColumn('storak_commission');
            $table->dropColumn('seller_commission');
            $table->dropColumn('user_store_commission');
            $table->dropColumn('user_store_reference_key');
        });
    }
}

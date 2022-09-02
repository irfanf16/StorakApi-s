<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommissionToOrderPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_packages', function (Blueprint $table) {
            $table->float('storak_commission')->nullable()->after('package_bill');
            $table->float('seller_commission')->nullable()->after('storak_commission');
            $table->float('user_stores_commission')->nullable()->after('seller_commission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_packages', function (Blueprint $table) {
            $table->dropColumn('storak_commission');
            $table->dropColumn('seller_commission');
            $table->dropColumn('user_stores_commission');
        });
    }
}

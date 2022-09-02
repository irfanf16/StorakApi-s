<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommissionToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->float('storak_commission')->nullable()->after('final_bill');
            $table->float('sellers_commission')->nullable()->after('storak_commission');
            $table->float('user_stores_commission')->nullable()->after('sellers_commission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('storak_commission');
            $table->dropColumn('sellers_commission');
            $table->dropColumn('user_stores_commission');
        });
    }
}

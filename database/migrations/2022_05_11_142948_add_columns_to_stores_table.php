<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->boolean('is_verified')->after('holiday_end_date')->default(false);
            $table->boolean('featured')->after('is_verified')->default(1);
            $table->boolean('status')->after('featured')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('is_verified');
            $table->dropColumn('featured');
            $table->dropColumn('status');
        });
    }
}

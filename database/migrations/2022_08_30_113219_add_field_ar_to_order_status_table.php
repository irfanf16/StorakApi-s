<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldArToOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_status', function (Blueprint $table) {
            $table->string('status_ar')->after('status')->nullable();
            $table->longText('message_ar')->after('message')->nullable();
            $table->longText('description_ar')->after('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_status', function (Blueprint $table) {
            $table->dropColumn('status_ar');
            $table->dropColumn('message_ar');
            $table->dropColumn('description_ar');
        });
    }
}

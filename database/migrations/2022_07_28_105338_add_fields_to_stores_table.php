<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('store_name_ar')->nullable()->after('store_name');
            $table->string('tag_line_ar')->nullable()->after('tag_line');
            $table->longText('short_description_ar')->nullable()->after('short_description');
            $table->longText('detailed_description_ar')->nullable()->after('detailed_description');
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
            $table->dropColumn('store_name_ar');
            $table->dropColumn('tag_line_ar');
            $table->dropColumn('short_description_ar');
            $table->dropColumn('detailed_description_ar');
        });
    }
}

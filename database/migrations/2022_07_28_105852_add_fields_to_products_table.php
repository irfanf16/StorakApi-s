<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('name_ar');
            $table->dropColumn('short_description_ar');
            $table->dropColumn('detailed_description_ar');
        });
    }
}

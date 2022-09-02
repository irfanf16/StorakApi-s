<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUserStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_stores', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
            $table->string('name_ar')->nullable()->after('slug');
            $table->string('tag_line_ar')->nullable()->after('tag_line');
            $table->longText('description_ar')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_stores', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('name_ar');
            $table->dropColumn('tag_line_ar');
            $table->dropColumn('description_ar');
        });
    }
}

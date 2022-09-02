<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        |=====================================================================
        | This Migration is of Pivot Table  -- attributes + subcategories 
        |=====================================================================
        */
        Schema::create('attribute_subcategory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('attribute_id');

            // $table->timestamps();
            // $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            // $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_subcategory');
    }
}

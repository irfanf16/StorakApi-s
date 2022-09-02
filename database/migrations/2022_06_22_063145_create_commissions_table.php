<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('child_category_id');
            $table->integer('store_id')->nullable();
            $table->integer('storak_commission');
            $table->integer('user_stores_commission');
            $table->boolean('status')->default(1);
            $table->foreign('child_category_id')->references('id')->on('child_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commissions');
    }
}

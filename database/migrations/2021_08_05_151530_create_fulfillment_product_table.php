<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFulfillmentProductTable extends Migration
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
        | This Migration is of Pivot Table  -- fullfillments + products 
        |=====================================================================
        */
        Schema::create('fulfillment_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('fulfillment_id');

            // $table->timestamps();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // $table->foreign('fulfillment_id')->references('id')->on('fulfillments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fulfillment_product');
    }
}

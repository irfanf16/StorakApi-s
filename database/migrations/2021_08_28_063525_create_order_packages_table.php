<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('package_no',25);
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('fulfillment_id');
            $table->unsignedBigInteger('order_status_id');
            $table->unsignedBigInteger('fulfillment_charges');
            $table->unsignedBigInteger('package_bill');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('fulfillment_id')->references('id')->on('fulfillments')->onDelete('cascade');
            $table->foreign('order_status_id')->references('id')->on('order_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_packages');
    }
}

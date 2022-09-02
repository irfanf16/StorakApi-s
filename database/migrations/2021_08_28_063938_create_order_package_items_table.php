<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPackageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_package_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_package_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_variant_id');
            $table->integer('quantity');
            $table->integer('price');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('order_package_id')->references('id')->on('order_packages')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_package_items');
    }
}

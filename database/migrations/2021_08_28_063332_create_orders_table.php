<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no',25);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('billing_address_id');
            $table->unsignedBigInteger('shipping_address_id');
            $table->integer('packages_bill');
            $table->integer('discount');
            $table->integer('final_bill');
            $table->enum('payment_method', ['card', 'cod', 'bank_transfer']);
            $table->boolean('billing_status');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('billing_address_id')->references('id')->on('user_addresses')->onDelete('cascade');
            $table->foreign('shipping_address_id')->references('id')->on('user_addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

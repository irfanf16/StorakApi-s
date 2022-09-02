<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderShippingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shipping_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_company_id'); // VENDOR-ID
            $table->unsignedBigInteger('order_package_id');
            $table->unsignedBigInteger('goods_type_id');
            $table->unsignedBigInteger('order_status_id');

            $table->string('payment_method',50);
            $table->integer('receivable_amount');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('shipping_company_id')->references('id')->on('shipping_companies')->onDelete('cascade');
            $table->foreign('order_package_id')->references('id')->on('order_packages')->onDelete('cascade');
            $table->foreign('goods_type_id')->references('id')->on('goods_types')->onDelete('cascade');
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
        Schema::dropIfExists('order_shipping_requests');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPackageHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_package_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_package_id');
            $table->unsignedBigInteger('order_status_id');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('order_package_id')->references('id')->on('order_packages')->onDelete('cascade');
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
        Schema::dropIfExists('order_package_histories');
    }
}

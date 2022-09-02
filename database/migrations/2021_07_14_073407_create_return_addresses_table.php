<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id'); // Foreign Key

            $table->string('warehouse_name',255);
            $table->string('warehouse_phone_no',15);
            $table->string('warehouse_email',50);
            $table->unsignedBigInteger('country_id');   // Foreign Key
            $table->unsignedBigInteger('city_id');  // Foreign Key
            $table->string('warehouse_zone_no',255)->nullable();
            $table->string('warehouse_street_no',255)->nullable();
            $table->string('warehouse_building_no',255)->nullable();
            $table->string('warehouse_floor_no',255)->nullable();
            $table->string('warehouse_appartment_no',255)->nullable();
            $table->text('warehouse_address')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_addresses');
    }
}

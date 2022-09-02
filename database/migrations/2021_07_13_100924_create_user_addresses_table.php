<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('address_type_id');
            $table->boolean('user_default_address')->default(0); // Default Address 0 => false, 1=>true
            $table->string('user_zone_no',255)->nullable();
            $table->string('user_street_no',255)->nullable();
            $table->string('user_building_no',255)->nullable();
            $table->string('user_floor_no',255)->nullable();
            $table->string('user_appartment_no',255)->nullable();
            $table->text('user_address')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('address_type_id')->references('id')->on('address_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}

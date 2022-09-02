<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign Key
            $table->string('company_name',255)->nullable();
            $table->unsignedBigInteger('country_id')->unsigned(); // Foreign Key
            $table->unsignedBigInteger('city_id')->unsigned(); // Foreign Key

            // BUSINESS DETAILS
            $table->string('company_zone_no',255)->nullable();
            $table->string('company_street_no',255)->nullable();
            $table->string('company_building_no',255)->nullable();
            $table->string('company_floor_no',255)->nullable();
            $table->string('company_appartment_no',255)->nullable();
            $table->text('company_address')->nullable();
            
            // BUSINESS PERSON DETAILS
            $table->string('person_incharge_name',100)->nullable();
            $table->string('person_incharge_mobile',15)->nullable();
            $table->string('person_incharge_email',50)->nullable();
            $table->string('person_id_type',100)->default('cnic');
            $table->string('person_id_no',25);
            $table->string('person_id_front_image',100);
            $table->string('person_id_back_image',100);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('business_information');
    }
}


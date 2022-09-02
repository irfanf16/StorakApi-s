<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign Key

            $table->string('seller_id',25)->nullable(); // Dynamically Created
            $table->string('store_name',255);
            $table->string('tag_line',255)->nullable();
            $table->integer('category_id')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('detailed_description')->nullable();
            $table->string('logo_image',255)->nullable();
            $table->string('cover_image',255)->nullable();
            $table->boolean('holiday_mode')->default(0);
            $table->date('holiday_start_date')->nullable();
            $table->date('holiday_end_date')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}

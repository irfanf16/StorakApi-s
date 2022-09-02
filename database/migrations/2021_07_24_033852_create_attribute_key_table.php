<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeKeyTable extends Migration
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
        | This Migration is of Pivot Table  -- attributes + keys 
        |=====================================================================
        */
        Schema::create('attribute_key', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('key_id');

            // $table->timestamps();
            // $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            // $table->foreign('key_id')->references('id')->on('keys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_key');
    }
}

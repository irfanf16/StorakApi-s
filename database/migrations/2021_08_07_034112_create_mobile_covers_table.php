<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        |============================================================================
        | USE THIS CONDITION IF 
        | THIS TABLE'S MIGRATION IS NOT RUN YET BUT THIS TABLE EXISTS IN DB 
        |============================================================================    
        */
        if (!Schema::hasTable('mobile_covers')) {

            Schema::create('mobile_covers', function (Blueprint $table) {

                $table->id();
                $table->string('image');
                $table->boolean('status')->default(0);

                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_covers');
    }
    
}
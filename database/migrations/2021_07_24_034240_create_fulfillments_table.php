<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFulfillmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fulfillments', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('background_color',25)->nullable();
            $table->string('description',255)->nullable();
            $table->integer('charges');
            $table->boolean('status')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fulfillments');
    }
}

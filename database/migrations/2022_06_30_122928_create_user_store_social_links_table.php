<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStoreSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_store_social_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('social_link_id');
            $table->foreign('social_link_id')->references('id')->on('social_links')->onDelete('cascade');
            $table->unsignedBigInteger('user_store_id');
            $table->foreign('user_store_id')->references('id')->on('user_stores')->onDelete('cascade');
            $table->string('link');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_store_social_links');
    }
}

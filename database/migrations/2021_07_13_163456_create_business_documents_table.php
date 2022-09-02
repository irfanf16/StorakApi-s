<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_information_id'); // Foreign Key
            $table->unsignedBigInteger('document_input_id');  // Foreign Key
            $table->string('document_input_value');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('business_information_id')->references('id')->on('business_information')->onDelete('cascade');
            $table->foreign('document_input_id')->references('id')->on('document_inputs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_documents');
    }
}

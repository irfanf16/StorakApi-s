<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_inputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id'); // Foreign Key

            $table->string('input_name');
            $table->string('input_type');
            $table->boolean('input_status')->default(1);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_inputs');
    }
}

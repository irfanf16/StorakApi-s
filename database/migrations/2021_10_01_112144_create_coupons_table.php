<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('apply_to', ['store','sku']);
            // $table->unsignedBigInteger('product_variant_id')->nullable();
            $table->string('code')->unique();
            $table->integer('quantity')->nullable();
            $table->enum('discount_type', ['percent','amount']);
            $table->integer('discount_value');
            $table->integer('minimum_order_value')->nullable();
            $table->enum('status', ['enable','disable'])->default('enable');
            $table->integer('remaining_coupons');
            $table->integer('per_user_limit')->default(1);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('expire_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}

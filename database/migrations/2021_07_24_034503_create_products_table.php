<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('childcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('store_id');
            $table->string('video_url')->nullable();

            $table->text('short_description',500);
            $table->longText('detailed_description')->nullable();
            $table->longText('package_contents')->nullable();
            $table->string('primary_image');

            // Service
            $table->integer('warranty_type');
            $table->unsignedBigInteger('warranty_period_id')->nullable(); // Nedd to run migration
            $table->text('warranty_policy')->nullable();

            // Delivery
            $table->float('package_weight');
            $table->float('package_length');
            $table->float('package_width');
            $table->float('package_height');
            $table->integer('good_type')->nullable(); // Flammable/Poisonous/Gas/Acid/Dangerous

            $table->boolean('status')->default(1);
            $table->boolean('featured')->default(0);

            // Stats
            $table->integer('likes')->default(0);
            $table->integer('views')->default(0);
            $table->integer('sales')->default(0);
            $table->integer('reports')->default(0);
            $table->timestamp('recently_viewed')->nullable();

            $table->integer('total_reviews')->default(0);
            $table->integer('total_rating')->default(0);
            $table->float('avg_rating')->default(0);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('childcategory_id')->references('id')->on('child_categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('warranty_period_id')->references('id')->on('warranty_periods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

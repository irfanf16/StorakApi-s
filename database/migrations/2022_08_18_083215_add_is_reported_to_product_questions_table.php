<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsReportedToProductQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_questions', function (Blueprint $table) {
            $table->boolean('is_reported')->default(0)->after('status');
            $table->string('reported_by')->nullable()->after('is_reported');
            $table->boolean('is_viewed')->default(0)->after('reported_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_questions', function (Blueprint $table) {
            $table->dropColumn('is_reported');
            $table->dropColumn('reported_by');
            $table->dropColumn('is_viewed');
        });
    }
}

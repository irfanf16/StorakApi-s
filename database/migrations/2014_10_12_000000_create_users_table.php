<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('role_id');
            $table->string('registered_with')->default('signup');
            $table->string('provider_id')->nullable();
            $table->string('email');
            $table->string('email_confirmation_code')->nullable();
            $table->boolean('is_email_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('mobile');
            $table->boolean('is_mobile_verified')->default(0);
            $table->string('phone')->nullable();
            $table->string('profile_image')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('vendor_profile_status')->nullable();
            $table->timestamp('last_login')->nullable();

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
        Schema::dropIfExists('users');
    }
}

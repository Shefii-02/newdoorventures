<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('re_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 120);
            $table->string('last_name', 120);
            $table->text('description')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('email', 191)->unique();
            $table->string('username', 60)->nullable()->unique();
            $table->string('password', 191);
            $table->unsignedBigInteger('avatar_id')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone', 25)->nullable();
            $table->unsignedInteger('credits')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->string('email_verify_token', 120)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('is_featured')->nullable()->default(false);
            $table->boolean('is_public_profile')->nullable()->default(false);
            $table->string('company')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('status', 10)->nullable()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_accounts');
    }
};

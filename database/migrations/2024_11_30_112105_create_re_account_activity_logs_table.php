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
        Schema::create('re_account_activity_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action', 120);
            $table->text('user_agent')->nullable();
            $table->string('reference_url')->nullable();
            $table->string('reference_name')->nullable();
            $table->string('ip_address', 39)->nullable();
            $table->unsignedBigInteger('account_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_account_activity_logs');
    }
};

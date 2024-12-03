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
        Schema::create('audit_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('module', 60)->index();
            $table->longText('request')->nullable();
            $table->string('action', 120);
            $table->text('user_agent')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->unsignedBigInteger('reference_user');
            $table->unsignedBigInteger('reference_id');
            $table->string('reference_name');
            $table->string('type', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_histories');
    }
};

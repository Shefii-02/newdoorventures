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
        Schema::create('re_configration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120);
            $table->string('icon', 60)->nullable();
            $table->string('status', 60)->nullable()->default('published');
            $table->timestamps();
            $table->boolean('has_rent')->nullable()->default(false);
            $table->boolean('has_sell')->nullable()->default(false);
            $table->boolean('has_pg')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_configration');
    }
};

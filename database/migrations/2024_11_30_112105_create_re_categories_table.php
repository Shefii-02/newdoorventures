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
        Schema::create('re_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120);
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->unsignedInteger('order')->default(0);
            $table->tinyInteger('is_default')->default(0);
            $table->boolean('has_rent')->nullable()->default(false);
            $table->boolean('has_sell')->nullable()->default(false);
            $table->boolean('has_pg')->nullable()->default(false);
            $table->boolean('has_residential')->nullable()->default(false);
            $table->boolean('has_commercial')->nullable()->default(false);
            $table->timestamps();
            $table->unsignedBigInteger('parent_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_categories');
    }
};

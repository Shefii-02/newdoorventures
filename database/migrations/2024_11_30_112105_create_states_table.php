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
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120);
            $table->string('slug', 120)->nullable()->unique();
            $table->string('abbreviation', 10)->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->tinyInteger('order')->default(0);
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('is_default')->default(0);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};

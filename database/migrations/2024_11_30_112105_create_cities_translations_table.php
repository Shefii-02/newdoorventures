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
        Schema::create('cities_translations', function (Blueprint $table) {
            $table->string('lang_code', 20);
            $table->unsignedBigInteger('cities_id');
            $table->string('name', 120)->nullable();
            $table->string('slug', 120)->nullable();

            $table->primary(['lang_code', 'cities_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities_translations');
    }
};

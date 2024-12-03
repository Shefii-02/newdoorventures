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
        Schema::create('countries_translations', function (Blueprint $table) {
            $table->string('lang_code', 20);
            $table->unsignedBigInteger('countries_id');
            $table->string('name', 120)->nullable();
            $table->string('nationality', 120)->nullable();

            $table->primary(['lang_code', 'countries_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries_translations');
    }
};

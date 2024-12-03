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
        Schema::create('testimonials_translations', function (Blueprint $table) {
            $table->string('lang_code', 20);
            $table->unsignedBigInteger('testimonials_id');
            $table->string('name')->nullable();
            $table->text('content')->nullable();
            $table->string('company', 120)->nullable();

            $table->primary(['lang_code', 'testimonials_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials_translations');
    }
};

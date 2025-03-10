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
        Schema::create('faq_categories_translations', function (Blueprint $table) {
            $table->string('lang_code', 20);
            $table->unsignedBigInteger('faq_categories_id');
            $table->string('name', 120)->nullable();

            $table->primary(['lang_code', 'faq_categories_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_categories_translations');
    }
};

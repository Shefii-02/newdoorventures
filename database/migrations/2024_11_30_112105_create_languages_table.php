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
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('lang_id');
            $table->string('lang_name', 120);
            $table->string('lang_locale', 20)->index('lang_locale_index');
            $table->string('lang_code', 20)->index('lang_code_index');
            $table->string('lang_flag', 20)->nullable();
            $table->unsignedTinyInteger('lang_is_default')->default(0)->index('lang_is_default_index');
            $table->integer('lang_order')->default(0);
            $table->unsignedTinyInteger('lang_is_rtl')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};

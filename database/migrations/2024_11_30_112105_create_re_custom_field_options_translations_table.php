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
        Schema::create('re_custom_field_options_translations', function (Blueprint $table) {
            $table->string('lang_code', 191);
            $table->unsignedBigInteger('re_custom_field_options_id');
            $table->string('label')->nullable();
            $table->string('value')->nullable();

            $table->primary(['lang_code', 're_custom_field_options_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_custom_field_options_translations');
    }
};

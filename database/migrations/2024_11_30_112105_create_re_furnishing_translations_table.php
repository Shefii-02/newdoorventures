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
        Schema::create('re_furnishing_translations', function (Blueprint $table) {
            $table->string('lang_code', 191);
            $table->unsignedBigInteger('re_features_id');
            $table->string('name')->nullable();

            $table->primary(['lang_code', 're_features_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_furnishing_translations');
    }
};

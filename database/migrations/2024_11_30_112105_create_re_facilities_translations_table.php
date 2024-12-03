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
        Schema::create('re_facilities_translations', function (Blueprint $table) {
            $table->string('lang_code', 191);
            $table->unsignedBigInteger('re_facilities_id');
            $table->string('name')->nullable();

            $table->primary(['lang_code', 're_facilities_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_facilities_translations');
    }
};

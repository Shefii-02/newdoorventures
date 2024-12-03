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
        Schema::create('re_properties_translations', function (Blueprint $table) {
            $table->string('lang_code', 191);
            $table->unsignedBigInteger('re_properties_id');
            $table->string('name')->nullable();
            $table->string('description', 400)->nullable();
            $table->longText('content')->nullable();
            $table->string('location')->nullable();

            $table->primary(['lang_code', 're_properties_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_properties_translations');
    }
};

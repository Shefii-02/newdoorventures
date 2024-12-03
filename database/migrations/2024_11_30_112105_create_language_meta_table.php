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
        Schema::create('language_meta', function (Blueprint $table) {
            $table->bigIncrements('lang_meta_id');
            $table->string('lang_meta_code', 20)->nullable()->index('meta_code_index');
            $table->string('lang_meta_origin', 32)->index('meta_origin_index');
            $table->unsignedBigInteger('reference_id')->index();
            $table->string('reference_type', 120)->index('meta_reference_type_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_meta');
    }
};

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
        Schema::create('re_investors_translations', function (Blueprint $table) {
            $table->string('lang_code', 191);
            $table->unsignedBigInteger('re_investors_id');
            $table->string('name')->nullable();

            $table->primary(['lang_code', 're_investors_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_investors_translations');
    }
};

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
        Schema::create('re_project_price_variations', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->string('unit_type')->nullable();
            $table->string('size')->nullable();
            $table->string('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_project_price_variations');
    }
};

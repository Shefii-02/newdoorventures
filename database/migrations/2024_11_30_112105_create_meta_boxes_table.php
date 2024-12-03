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
        Schema::create('meta_boxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('meta_key');
            $table->text('meta_value')->nullable();
            $table->unsignedBigInteger('reference_id')->index();
            $table->string('reference_type', 120);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_boxes');
    }
};

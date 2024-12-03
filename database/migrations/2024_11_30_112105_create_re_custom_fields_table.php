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
        Schema::create('re_custom_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type', 60);
            $table->integer('order')->default(999);
            $table->boolean('is_global')->default(false);
            $table->string('authorable_type', 191)->nullable();
            $table->unsignedBigInteger('authorable_id')->nullable();
            $table->timestamps();

            $table->index(['authorable_type', 'authorable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_custom_fields');
    }
};

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
        Schema::create('re_project_specifications', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('project_id');
            $table->text('image')->nullable();
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->integer('order')->nullable()->default(999);
            $table->boolean('is_global')->nullable()->default(false);
            $table->unsignedBigInteger('authorable_id')->nullable();
            $table->string('authorable_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_project_specifications');
    }
};

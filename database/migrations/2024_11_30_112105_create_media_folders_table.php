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
        Schema::create('media_folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name')->nullable();
            $table->string('color', 250)->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['parent_id', 'user_id', 'created_at'], 'media_folders_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_folders');
    }
};

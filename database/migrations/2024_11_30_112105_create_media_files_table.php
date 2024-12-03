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
        Schema::create('media_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name');
            $table->string('alt')->nullable();
            $table->unsignedBigInteger('folder_id')->default(0);
            $table->string('mime_type', 120);
            $table->integer('size');
            $table->string('url');
            $table->text('options')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['folder_id', 'user_id', 'created_at'], 'media_files_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};

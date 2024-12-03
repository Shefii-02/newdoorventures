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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description', 400)->nullable();
            $table->longText('content')->nullable();
            $table->string('status', 60)->default('published')->index();
            $table->unsignedBigInteger('author_id')->nullable()->index();
            $table->string('author_type')->default('Botble\\\\ACL\\\\Models\\\\User')->index();
            $table->unsignedTinyInteger('is_featured')->default(0);
            $table->string('image')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->string('format_type', 30)->nullable();
            $table->timestamp('created_at')->nullable()->index();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

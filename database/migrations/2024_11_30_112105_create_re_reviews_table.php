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
        Schema::create('re_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->string('reviewable_type', 191);
            $table->unsignedBigInteger('reviewable_id');
            $table->tinyInteger('star');
            $table->string('content', 500);
            $table->string('status', 60)->default('approved');
            $table->timestamps();

            $table->unique(['account_id', 'reviewable_id', 'reviewable_type'], 'reviews_unique');
            $table->index(['reviewable_type', 'reviewable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_reviews');
    }
};

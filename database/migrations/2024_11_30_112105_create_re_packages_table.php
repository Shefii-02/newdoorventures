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
        Schema::create('re_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120);
            $table->double('price')->unsigned();
            $table->unsignedBigInteger('currency_id');
            $table->unsignedInteger('percent_save')->default(0);
            $table->unsignedInteger('number_of_listings');
            $table->unsignedInteger('account_limit')->nullable();
            $table->tinyInteger('order')->default(0);
            $table->unsignedTinyInteger('is_default')->default(0);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_packages');
    }
};

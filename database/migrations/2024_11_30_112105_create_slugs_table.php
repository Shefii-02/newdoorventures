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
        Schema::create('slugs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key')->index();
            $table->unsignedBigInteger('reference_id')->index();
            $table->string('reference_type');
            $table->string('prefix', 120)->nullable()->default('')->index();
            $table->timestamps();

            $table->index(['reference_id', 'reference_type'], 'slugs_reference_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slugs');
    }
};

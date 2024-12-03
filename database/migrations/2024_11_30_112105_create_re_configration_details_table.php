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
        Schema::create('re_configration_details', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('configration_id');
            $table->unsignedBigInteger('reference_id');
            $table->string('reference_type');
            $table->string('distance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_configration_details');
    }
};

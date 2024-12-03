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
        Schema::create('re_coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 191);
            $table->string('code', 20)->unique();
            $table->decimal('value');
            $table->integer('quantity')->nullable();
            $table->unsignedInteger('total_used')->default(0);
            $table->dateTime('expires_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_coupons');
    }
};

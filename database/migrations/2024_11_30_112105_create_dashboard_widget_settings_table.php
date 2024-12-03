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
        Schema::create('dashboard_widget_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('settings')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('widget_id')->index();
            $table->unsignedTinyInteger('order')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_widget_settings');
    }
};

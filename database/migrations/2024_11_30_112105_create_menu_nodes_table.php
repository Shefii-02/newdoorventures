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
        Schema::create('menu_nodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_id')->index();
            $table->unsignedBigInteger('parent_id')->default(0)->index();
            $table->unsignedBigInteger('reference_id')->nullable()->index('reference_id');
            $table->string('reference_type')->nullable()->index('reference_type');
            $table->string('url', 120)->nullable();
            $table->string('icon_font', 50)->nullable();
            $table->unsignedTinyInteger('position')->default(0);
            $table->string('title', 120)->nullable();
            $table->string('css_class', 120)->nullable();
            $table->string('target', 20)->default('_self');
            $table->unsignedTinyInteger('has_child')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_nodes');
    }
};

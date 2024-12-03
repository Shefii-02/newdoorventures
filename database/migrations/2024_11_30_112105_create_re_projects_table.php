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
        Schema::create('re_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 300);
            $table->text('slug')->nullable();
            $table->string('description', 400)->nullable();
            $table->longText('content')->nullable();
            $table->text('images')->nullable();
            $table->string('location', 191)->nullable();
            $table->unsignedBigInteger('investor_id')->nullable();
            $table->integer('number_block')->nullable();
            $table->smallInteger('number_floor')->nullable();
            $table->smallInteger('number_flat')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->date('date_finish')->nullable();
            $table->date('date_sell')->nullable();
            $table->decimal('price_from', 15, 0)->nullable();
            $table->decimal('price_to', 15, 0)->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('status', 60)->default('selling');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->string('author_type')->default('Botble\\\\ACL\\\\Models\\\\User');
            $table->timestamps();
            $table->string('latitude', 25)->nullable();
            $table->string('longitude', 25)->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->unsignedBigInteger('country_id')->nullable()->default(1);
            $table->unsignedBigInteger('state_id')->nullable();
            $table->text('videos')->nullable();
            $table->text('youtube_video')->nullable();
            $table->text('master_plan_images')->nullable();
            $table->string('rent_properties', 120)->nullable();
            $table->string('resale_properties', 120)->nullable();
            $table->string('furnishing_status', 120)->nullable();
            $table->string('construction_status', 120)->nullable();
            $table->string('rera_status', 60)->nullable();
            $table->text('rera_reg_no')->nullable();
            $table->string('unique_id', 191)->nullable()->unique();
            $table->string('possession', 120)->nullable();
            $table->string('tower', 120)->nullable();
            $table->string('unit', 120)->nullable();
            $table->string('review_rate', 10)->nullable();
            $table->string('square', 120)->nullable();
            $table->text('city')->nullable();
            $table->text('locality')->nullable();
            $table->text('sub_locality')->nullable();
            $table->text('landmark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_projects');
    }
};

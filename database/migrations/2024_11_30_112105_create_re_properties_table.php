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
        Schema::create('re_properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 300);
            $table->text('slug')->nullable();
            $table->string('type', 20)->default('sale');
            $table->string('description', 400)->nullable();
            $table->longText('content')->nullable();
            $table->string('location', 191)->nullable();
            $table->text('images')->nullable();
            $table->text('video')->nullable();
            $table->unsignedBigInteger('project_id')->nullable()->default(0);
            $table->integer('number_bedroom')->nullable();
            $table->string('unit_info', 250)->nullable();
            $table->integer('number_bathroom')->nullable();
            $table->integer('number_floor')->nullable();
            $table->double('square')->nullable();
            $table->decimal('price', 15)->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('period', 30)->default('month');
            $table->string('status', 60)->default('selling');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->string('author_type')->default('Botble\\\\ACL\\\\Models\\\\User');
            $table->string('moderation_status', 60)->default('pending');
            $table->string('furnishing_status', 60)->nullable();
            $table->string('construction_status', 60)->nullable();
            $table->date('expire_date')->nullable();
            $table->boolean('auto_renew')->default(false);
            $table->boolean('never_expired')->default(false);
            $table->timestamps();
            $table->string('latitude', 25)->nullable();
            $table->string('longitude', 25)->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->unsignedBigInteger('country_id')->nullable()->default(1);
            $table->unsignedBigInteger('state_id')->nullable();
            $table->text('unique_id')->nullable();
            $table->string('city', 250)->nullable();
            $table->string('locality', 250)->nullable();
            $table->string('sub_locality', 250)->nullable();
            $table->string('apartment', 250)->nullable();
            $table->string('youtube_video', 250)->nullable();
            $table->text('landmark')->nullable();
            $table->integer('available_floor')->nullable()->default(0);
            $table->integer('balconies')->nullable()->default(0);
            $table->decimal('carpet_area', 10)->nullable();
            $table->decimal('built_up_area', 10)->nullable();
            $table->integer('covered_parking')->nullable()->default(0);
            $table->integer('open_parking')->nullable()->default(0);
            $table->string('property_age', 250)->nullable();
            $table->string('possession', 250)->nullable();
            $table->string('cover_image', 250)->nullable();
            $table->string('ownership', 250)->nullable();
            $table->boolean('all_include')->nullable()->default(false);
            $table->boolean('tax_include')->nullable()->default(false);
            $table->boolean('negotiable')->nullable()->default(false);
            $table->string('mode', 250)->nullable();
            $table->string('occupancy_type', 60)->nullable()->comment('single,double,capsule');
            $table->string('available_for', 60)->nullable()->comment('boys,girls,both');
            $table->string('plot_area', 120)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_properties');
    }
};

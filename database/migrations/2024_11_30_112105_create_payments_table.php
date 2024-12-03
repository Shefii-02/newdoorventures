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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency', 120)->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('charge_id')->nullable();
            $table->string('payment_channel', 60)->nullable();
            $table->string('description')->nullable();
            $table->decimal('amount', 15)->unsigned();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('status', 60)->nullable()->default('pending');
            $table->string('payment_type', 191)->nullable()->default('confirm');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('refunded_amount', 15)->unsigned()->nullable();
            $table->string('refund_note')->nullable();
            $table->timestamps();
            $table->string('customer_type')->nullable();
            $table->mediumText('metadata')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

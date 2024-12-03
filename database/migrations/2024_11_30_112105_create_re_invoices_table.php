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
        Schema::create('re_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('payment_id')->nullable()->index();
            $table->string('reference_type', 191);
            $table->unsignedBigInteger('reference_id');
            $table->string('code', 191)->unique();
            $table->decimal('sub_total', 15)->unsigned();
            $table->decimal('tax_amount', 15)->unsigned()->default(0);
            $table->decimal('discount_amount', 15)->unsigned()->default(0);
            $table->string('coupon_code', 191)->nullable();
            $table->decimal('amount', 15)->unsigned();
            $table->string('status', 191)->default('pending')->index();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['reference_type', 'reference_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_invoices');
    }
};

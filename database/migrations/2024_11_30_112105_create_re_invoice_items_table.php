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
        Schema::create('re_invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            $table->string('name', 191);
            $table->string('description', 191)->nullable();
            $table->unsignedInteger('qty');
            $table->decimal('sub_total', 15)->unsigned();
            $table->decimal('tax_amount', 15)->unsigned()->default(0);
            $table->decimal('discount_amount', 15)->unsigned()->default(0);
            $table->decimal('amount', 15)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_invoice_items');
    }
};

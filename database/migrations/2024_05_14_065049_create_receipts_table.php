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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_house_id', false, true)->nullable();
            $table->integer('proceed_by', false, true)->nullable();
            $table->string('receipt_no')->nullable();
            $table->integer('reservation_id', false, true)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->integer('receipt_to', false, true)->nullable();
            $table->timestamp('receipt_date')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};

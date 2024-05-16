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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id', false, true)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->integer('reservation_id', false, true)->nullable();
            $table->integer('proceed_by', false, true)->nullable();
            $table->integer('guest_house_id', false, true)->nullable();
            $table->integer('guest_id', false, true)->nullable();
            $table->string('payment_no')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->string('remarks')->nullable();
            $table->timestamp('transaction_time');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};

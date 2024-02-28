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
        Schema::create('room_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->integer('room_category', false, true)->nullable();
            $table->integer('room_book')->nullable();
            $table->date('date')->nullable();
            $table->timestamp('created_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_transactions');
    }
};

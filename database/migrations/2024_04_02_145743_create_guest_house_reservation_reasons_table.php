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
        Schema::create('guest_house_reservation_reasons', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_house_id',false, true)->nullable();
            $table->integer('reason_id', false, true)->nullable();
            $table->integer('offer')->nullable();
            $table->string('remarks')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_house_reservation_reasons');
    }
};

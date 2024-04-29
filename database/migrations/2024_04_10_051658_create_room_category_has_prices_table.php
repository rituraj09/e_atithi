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
        Schema::create('room_category_has_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_house_id', false, true)->nullable();
            $table->integer('room_category_id', false, true)->nullable();
            $table->decimal('price_modifier', 10, 2)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_category_has_prices');
    }
};

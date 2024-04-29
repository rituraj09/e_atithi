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
        Schema::create('bed_has_price_modifiers', function (Blueprint $table) {
            $table->id();
            $table->integer('bed_type',false, true)->nullable();
            $table->integer('guest_house_id',false, true)->nullable();
            $table->decimal('price_modifier',10,2)->nullable();
            $table->string('remarks')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bed_has_price_modifiers');
    }
};

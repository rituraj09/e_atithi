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
        Schema::create('rate_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('guest_house_id')->nullable();
            $table->integer('room_category', false, true)->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->boolean('is_active')->default(1);
            $table->softDelete();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_lists');
    }
};

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
        Schema::create('room_features', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id', false, true)->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('remarks')->nullable();
            $table->integer('created_by', false, true)->nullable();
            $table->boolean('is_active')->nullable();
            $table->timestamp('created_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_features');
    }
};

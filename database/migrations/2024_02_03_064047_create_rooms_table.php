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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number');
            $table->integer('guest_house_id', false, true)->nullable();
            $table->integer('room_type', false, true);                 // references('id', 'room_types');
            $table->integer('no_of_beds')->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('toilet_attached')->nullable();
            $table->float('width')->nullable();
            $table->float('length')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_delete')->default(0);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

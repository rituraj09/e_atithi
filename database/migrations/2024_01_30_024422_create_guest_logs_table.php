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
        Schema::create('guest_logs', function (Blueprint $table) {
            $table->id();
            $table->text('activity')->nullable();
            $table->integer('guest_id', false, true)->nullable();        // references('id', 'guest');
            $table->text('ip_address')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_delete')->default(1);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_logs');
    }
};

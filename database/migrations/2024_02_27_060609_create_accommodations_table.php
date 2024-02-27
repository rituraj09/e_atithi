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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('checkin_no');
            $table->integer('reservation_id', false, true)->nullable();
            $table->integer('room_id',false, true)->nullable();
            $table->integer('reservation_type', false, true)->nullable();
            $table->integer('rate_list_id', false, true)->nullable();
            $table->string('purpose_of_visit')->nullable();
            $table->integer('status')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('created_by', false, true)->nullable();  // admin/receptionist
            $table->boolean('is_active')->default(1);
            $table->timestamp('checkin_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};

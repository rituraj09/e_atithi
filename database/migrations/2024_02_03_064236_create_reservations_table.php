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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_id', false, true);     //references('id', 'guest');
            $table->integer('guest_house_id', false, true);     //references('id', 'guesthouses');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('no_of_room_required')->nullable();
            $table->integer('occupency')->nullable();
            $table->text('docs')->nullable();
            $table->integer('status')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('check_in_id')->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

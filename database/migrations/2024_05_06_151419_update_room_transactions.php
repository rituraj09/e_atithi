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
        //
        Schema::table('room_transactions', function (Blueprint $table) {
            $table->integer('guest_house_id', false, true)->nullable();
            $table->integer('proceed_by', false, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('room_transactions', function (Blueprint $table) {
            $table->dropColumn('guest_house_id');
            $table->dropColumn('proceed_by');
        });
    }
};

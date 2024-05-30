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
        Schema::table('room_on_dates', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->integer('reservation_id', false, true)->nullable();
            $table->boolean('is_cancelled')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('room_on_dates', function (Blueprint $table) {
            $table->dropColumn('is_cancelled');
            $table->dropColumn('reservation_id');
            $table->boolean('status')->nullable();
        });
    }
};

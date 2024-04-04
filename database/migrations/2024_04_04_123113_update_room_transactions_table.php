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
            $table->date('checked_in_date')->nullable();
            $table->time('checked_in_time')->nullable();
            $table->date('checked_out_date')->nullable();
            $table->time('checked_out_time')->nullable();
            $table->dropColumn('room_book');
            $table->dropColumn('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('room_transactions', function (Blueprint $table) {
            $table->dropColumn('checked_in_date');
            $table->dropColumn('checked_in_time');
            $table->dropColumn('checked_out_date');
            $table->dropColumn('checked_out_time');
            $table->integer('room_book');
            $table->date('date');
        });
    }
};

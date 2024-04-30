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
            $table->integer('room_id', false, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('room_transactions', function (Blueprint $table) {
            $table->dropColumn('room_id')->after('transaction_id');
        });
    }
};

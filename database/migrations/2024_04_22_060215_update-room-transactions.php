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
            $table->dropColumn('room_category');
            $table->integer('reservation_no', false, true)->nullable()->after('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('room_transactions', function (Blueprint $table) {
            $table->integer('room_category', false, true)->nullable();
            $table->dropColumn('reservation_no');
        });
    }
};

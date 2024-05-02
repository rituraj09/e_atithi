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
        Schema::table('reservations', function (Blueprint $table) {
            $table->date('request_date')->nullable();
            $table->date('cancellation_by_guest_date')->nullable();
            $table->date('cancellation_by_admin_date')->nullable();
            $table->date('approval_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('request_date')->nullable();
            $table->dropColumn('cancellation_by_guest_date')->nullable();
            $table->dropColumn('cancellation_by_admin_date')->nullable();
            $table->dropColumn('approval_date')->nullable();
        });
    }
};

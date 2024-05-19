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
            $table->string('guest_name', 120)->nullable();
            $table->integer('guest_category', false, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('guest_name');
            $table->dropColumn('guest_category');
        });
    }
};

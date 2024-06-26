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
        Schema::table('reservation_rooms', function (Blueprint $table) {
            $table->integer('reservation_id', false, true)->nullale()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('reservation_rooms', function (Blueprint $table) {
            $table->string('reservation_id')->nullable()->change();
        });
    }
};

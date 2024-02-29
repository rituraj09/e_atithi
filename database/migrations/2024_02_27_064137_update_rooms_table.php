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
        Schema::table('rooms', function (Blueprint $table) {
            //
            $table->integer('room_rate', false, true)->nullable();
            $table->softDeletes();
            $table->dropColumn('is_delete');
            $table->dropColumn('room_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('rooms', function (Blueprint $table) {
            //
            $table->dropColumn('room_rate');
            $table->integer('room_type', false, true)->nullable();
        });
    }
};

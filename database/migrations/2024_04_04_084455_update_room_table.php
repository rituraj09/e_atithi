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
        // add base price 
        Schema::table('rooms', function (Blueprint $table) {
            $table->decimal('base_price', 10, 2)->nullable();
            $table->integer('bed_type', false, true)->nullable();
            $table->integer('room_category',false, true)->nullable();
            $table->decimal('total_price',10, 2)->nullable();
            $table->dropColumn('room_rate');
            $table->dropColumn('toilet_attached');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('base_price');
            $table->dropColumn('bed_type');
            $table->dropColumn('total_price');
            $table->dropColumn('room_category');
            $table->integer('room_rate');
            $table->boolean('toilet_attached');
        });
    }
};

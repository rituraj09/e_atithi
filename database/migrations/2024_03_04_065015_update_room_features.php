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
        Schema::table('room_features', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->dropColumn('price');
            $table->dropColumn('remarks');
            $table->integer('feature_id', false, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('remarks')->nullable();
        });
    }
};

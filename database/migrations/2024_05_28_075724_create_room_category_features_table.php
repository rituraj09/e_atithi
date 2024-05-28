<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('room_category_features', function (Blueprint $table) {
            $table->id();
            $table->integer('feature_id', false, true)->nullable();
            $table->integer('room_category_id', false, true)->nullable();
            $table->integer('guest_house_id', false, true)->nullable();
            $table->integer('created_by', false, true)->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_category_features');
    }
};

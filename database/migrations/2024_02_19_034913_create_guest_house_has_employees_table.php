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
        Schema::create('guest_house_has_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_house_id', false, true)->nullable();
            $table->integer('employee_id', false, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_house_has_employees');
    }
};

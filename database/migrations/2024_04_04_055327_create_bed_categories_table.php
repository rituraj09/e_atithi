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
        Schema::create('bed_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->integer('capacity')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('admin_id',false, true)->nullable();  // default super admin and if a guest house creates a custom one, it would becomes the admin id of the guest house.
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bed_categories');
    }
};

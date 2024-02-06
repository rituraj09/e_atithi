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
        Schema::create('guest', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('password')->nullable();
            $table->integer('otp')->nullable();
            $table->date('dob')->nullable();
            $table->integer('guestcategory_id', false, true)->nullable();         // references('id', 'guest_categories');
            $table->string('nationality',20)->nullable();
            $table->text('address')->nullable();
            $table->integer('gender')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('id_card_no')->nullable();
            $table->string('id_card_type')->nullable();
            $table->string('remarks')->nullable();
            $table->boolean('is_active')->default(0);
            $table->boolean('is_delete')->default(0);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest');
    }
};

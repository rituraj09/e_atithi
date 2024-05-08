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
        Schema::create('guest_details', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_id', false, true);
            $table->integer('guestcategory_id', false, true)->nullable();         // references('id', 'guest_categories');
            $table->string('nationality',20)->nullable();
            $table->text('address')->nullable();
            $table->integer('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('id_card_file')->nullable();
            $table->string('id_card_type')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_details');
    }
};

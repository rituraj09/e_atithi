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
        Schema::create('guesthouses', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('official_email')->nullable();
            $table->text('contact_no')->nullable();
            $table->integer('department', false, true)->nullable();
            $table->text('address')->nullable();
            $table->integer('district', false, true);        // references('id' ,'districts');
            $table->integer('state', false, true);       //references('id', 'states');
            $table->integer('country', false, true);          // references('id', 'countries');
            $table->text('pin');
            $table->integer('guest_house_type', false, true);       //references('id', 'guest_house_types');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_delete')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guesthouses');
    }
};

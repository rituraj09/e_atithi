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
        Schema::table('guesthouses', function (Blueprint $table) {
            $table->decimal('base_price', 10, 2)->nullable();
            $table->boolean('payment_type')->default(1);    // 1 postpaid, 0 prepaid
            $table->boolean('guest_type')->default(1);      // 1 govt employee, 0 govt-employee / general-public
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('guesthouses', function (Blueprint $table) {
            $table->dropColumn('base_price');
            $table->dropColumn('payment_type');
            $table->dropColumn('guest_type');
        });
    }
};

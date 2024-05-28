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
            $table->decimal('govt_base_price',10,2)->nullable();
            $table->decimal('cgst',10,2)->nullable();
            $table->decimal('sgst',10,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('guesthouses', function (Blueprint $table) {
            $table->dropColumn('govt_base_price');
            $table->dropColumn('cgst');
            $table->dropColumn('sgst');
        });
    }
};

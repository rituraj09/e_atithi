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
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('reservation_no');
            $table->integer('reservation_type', false, true)->nullable();
            $table->decimal('charges_of_accomodation',10,2)->nullable();
            $table->text('remarks_by_guest')->nullable();
            $table->text('remarks_by_admin')->nullable();
            $table->integer('approved_by', false, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
    }
};

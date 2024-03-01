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
        Schema::table('guest_house_types', function (Blueprint $table) {
            $table->softDeletes();
            $table->dropColumn('is_delete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('guest_house_types', function (Blueprint $table) {
            $table->boolean('is_delete')->default(0);
        });
    }
};

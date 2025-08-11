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
        Schema::table('prospect', function (Blueprint $table) {
            $table->unsignedBigInteger('land_id')->nullable()->after('properties_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prospect', function (Blueprint $table) {
            $table->dropColumn('land_id');
        });
    }
};

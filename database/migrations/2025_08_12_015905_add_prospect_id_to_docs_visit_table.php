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
        Schema::table('visit_docs', function (Blueprint $table) {
            $table->unsignedBigInteger('prospect_id')->comment('fk to prospect table')->after('id');
            $table->foreign('prospect_id')->references('id')->on('prospect')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visit_docs', function (Blueprint $table) {
            $table->dropColumn('prospect_id');
        });
    }
};

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
        Schema::create('property_feature', function (Blueprint $table) {
            $table->id();
            $table->foreignId('properties_id')->comment('fk to properties table');
            $table->foreignId('feature_id')->comment('fk to feature_list table');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_feature');
    }
};

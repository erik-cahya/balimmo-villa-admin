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
        Schema::create('properties_file', function (Blueprint $table) {
            $table->id();
            $table->foreignId('properties_id');
            $table->text('featured_image')->nullable();
            $table->text('gallery')->nullable();
            $table->text('property_plan')->nullable();
            $table->text('ownership_certificate')->nullable();
            $table->text('imb_pbg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties_file');
    }
};

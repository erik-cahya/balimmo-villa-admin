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
        Schema::create('properties_feature_value', function (Blueprint $table) {
            $table->id();
            $table->foreignId('properties_id')->constrained()->on('properties')->onDelete('cascade');
            $table->foreignId('properties_feature_id')->constrained()->on('properties_feature')->onDelete('cascade');
            $table->text('value');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties_feature_value');
    }
};

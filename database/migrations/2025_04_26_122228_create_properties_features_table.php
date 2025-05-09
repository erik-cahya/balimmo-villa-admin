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
        Schema::create('properties_feature', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('properties_id')->constrained()->on('properties')->onDelete('cascade');
            $table->foreignId('properties_id');
            $table->string('features_name');
            $table->text('features_value');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villa_features');
    }
};

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
        Schema::create('prospect_properties_selected', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prospect_id')->comment('fk to prospect table');
            $table->unsignedBigInteger('properties_id')->comment('fk to properties table');
            $table->timestamps();

            $table->foreign('properties_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('prospect_id')->references('id')->on('prospect')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospect_properties_selected');
    }
};

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
        Schema::create('land_feature', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('land_id')->comment('fk to land table');
            $table->foreignId('feature_land_id')->comment('fk to feature_land_list table');

            $table->timestamps();

            // Foreign Key Constraint with ON DELETE CASCADE
            $table->foreign('land_id')->references('id')->on('land')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_feature');
    }
};

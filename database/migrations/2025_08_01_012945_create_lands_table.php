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
        Schema::create('land', function (Blueprint $table) {
            $table->id();

            $table->string('type_properties')->nullable();
            $table->string('land_code');
            $table->string('land_name');
            $table->text('land_slug');
            $table->string('internal_reference')->nullable();

            $table->text('land_description')->nullable();
            $table->string('region')->nullable();
            $table->string('sub_region')->nullable();
            $table->text('land_address')->nullable();
            $table->float('total_land_area')->nullable();
            $table->float('land_width')->nullable();
            $table->float('land_length')->nullable();
            $table->string('is_land_split')->nullable();
            $table->string('minimum_split')->nullable();
            $table->string('type_mandate')->nullable();

            $table->enum('type_acceptance', ['accept', 'pending', 'decline']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lands');
    }
};

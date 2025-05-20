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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_code');
            $table->string('property_name');
            $table->text('property_slug');
            $table->string('internal_reference')->nullable();

            $table->text('property_description');
            $table->string('region')->nullable();
            $table->string('sub_region')->nullable();
            $table->text('property_address')->nullable();
            $table->float('total_land_area')->nullable();
            $table->float('villa_area')->nullable();
            $table->float('pool_area')->nullable();
            $table->integer('bedroom')->nullable();
            $table->integer('bathroom')->nullable();
            $table->year('year_construction')->nullable();
            $table->year('year_renovated')->nullable();
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
        Schema::dropIfExists('properties');
    }
};

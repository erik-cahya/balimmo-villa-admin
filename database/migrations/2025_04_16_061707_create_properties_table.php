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
            $table->string('property_name');
            $table->string('property_type');
            $table->string('region')->nullable();
            $table->string('sub_region')->nullable();
            $table->string('street')->nullable();
            $table->string('internal_reference')->nullable();
            $table->string('status')->nullable();
            $table->string('year_built')->nullable();
            $table->string('current_owner')->nullable();
            $table->string('owner_contact')->nullable();
            $table->string('property_category')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('extension_leasehold_possible')->nullable();
            $table->string('leasehold_extension')->nullable();
            $table->integer('rent_price')->nullable();
            $table->integer('price')->nullable();
            $table->integer('anuual_fees')->nullable();
            $table->string('estimated_rental')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villa');
    }
};

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
            $table->uuid('property_uuid');
            $table->string('property_name');
            $table->string('property_type');
            $table->string('region')->nullable();
            $table->string('sub_region')->nullable();
            $table->text('property_address')->nullable();
            $table->string('internal_reference')->nullable();
            $table->string('property_status')->nullable();

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
            $table->integer('annual_fees')->nullable();
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

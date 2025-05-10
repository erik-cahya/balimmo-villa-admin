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
            $table->timestamps();






            // $table->string('property_type');
            // $table->string('property_status')->nullable();

            // $table->string('year_built')->nullable();
            // $table->string('current_owner')->nullable();
            // $table->string('owner_contact')->nullable();
            // $table->string('property_category')->nullable();

            // $table->date('start_date')->nullable();
            // $table->date('end_date')->nullable();
            
            // $table->string('extension_leasehold_possible')->nullable();
            // $table->string('leasehold_extension')->nullable();
            // $table->float('rent_price')->nullable();
            // $table->float('price')->nullable();
            // $table->float('annual_fees')->nullable();
            // $table->float('estimated_rental')->nullable();
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

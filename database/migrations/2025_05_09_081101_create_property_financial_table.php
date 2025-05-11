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
        Schema::create('property_financial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('properties_id')->comment('fk to properties table');
            
            $table->integer('avg_nightly_rate')->nullable();
            $table->float('avg_occupancy_rate')->nullable();
            $table->integer('months_rented')->nullable();
            $table->integer('annual_turnover')->nullable();
            $table->text('document_support')->nullable();

            $table->integer('selling_price_idr')->nullable();
            $table->float('selling_price_usd')->nullable();
            $table->integer('commision_ammount_idr')->nullable();
            $table->float('commision_ammount_usd')->nullable();
            $table->integer('net_seller_idr')->nullable();
            $table->float('net_seller_usd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_rental_price');
    }
};
